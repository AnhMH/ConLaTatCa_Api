<?php

use Fuel\Core\DB;

/**
 * Any query in Model Version
 *
 * @package Model
 * @created 2017-10-29
 * @version 1.0
 * @author AnhMH
 */
class Model_Post extends Model_Abstract {
    
    /** @var array $_properties field of table */
    protected static $_properties = array(
        'id',
        'cate_id',
        'name',
        'description',
        'content',
        'image',
        'is_default',
        'is_home_slide',
        'is_hot',
        'type',
        'created',
        'updated',
        'disable'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events'          => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events'          => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );

    /** @var array $_table_name name of table */
    protected static $_table_name = 'posts';

    /**
     * Add update info
     *
     * @author AnhMH
     * @param array $param Input data
     * @return int|bool User ID or false if error
     */
    public static function add_update($param)
    {
        // Init
        $self = array();
        
        // Check if exist User
        if (!empty($param['id'])) {
            $self = self::find($param['id']);
            if (empty($self)) {
                self::errorNotExist('post_id');
                return false;
            }
        } else {
            $self = new self;
        }
        
        // Upload image
        if (!empty($_FILES)) {
            $uploadResult = \Lib\Util::uploadImage(); 
            if ($uploadResult['status'] != 200) {
                self::setError($uploadResult['error']);
                return false;
            }
            $param['image'] = !empty($uploadResult['body']['image']) ? $uploadResult['body']['image'] : '';
        }
        
        // Set data
        if (!empty($param['name'])) {
            $self->set('name', $param['name']);
        }
        if (!empty($param['cate_id'])) {
            $self->set('cate_id', $param['cate_id']);
        }
        if (!empty($param['description'])) {
            $self->set('description', $param['description']);
        }
        if (!empty($param['content'])) {
            $self->set('content', $param['content']);
        }
        if (!empty($param['image'])) {
            $self->set('image', $param['image']);
        }
        
        // Save data
        if ($self->save()) {
            if (empty($self->id)) {
                $self->id = self::cached_object($self)->_original['id'];
            }
            return $self->id;
        }
        
        return false;
    }
    
    /**
     * Get list
     *
     * @author AnhMH
     * @param array $param Input data
     * @return array|bool
     */
    public static function get_list($param)
    {
        // Init
        $adminId = !empty($param['admin_id']) ? $param['admin_id'] : '';
        
        // Query
        $query = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(self::$_table_name)
            ->join('cates', 'left')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
        ;
                        
        // Filter
        if (!empty($param['name'])) {
            $query->where(self::$_table_name.'.name', 'LIKE', "%{$param['name']}%");
        }
        
        if (isset($param['disable']) && $param['disable'] != '') {
            $disable = !empty($param['disable']) ? 1 : 0;
            $query->where(self::$_table_name.'.disable', $disable);
        }
        
        // Pagination
        if (!empty($param['page']) && $param['limit']) {
            $offset = ($param['page'] - 1) * $param['limit'];
            $query->limit($param['limit'])->offset($offset);
        }
        
        // Sort
        if (!empty($param['sort'])) {
            if (!self::checkSort($param['sort'])) {
                self::errorParamInvalid('sort');
                return false;
            }

            $sortExplode = explode('-', $param['sort']);
            if ($sortExplode[0] == 'created') {
                $sortExplode[0] = self::$_table_name . '.created';
            }
            $query->order_by($sortExplode[0], $sortExplode[1]);
        } else {
            $query->order_by(self::$_table_name . '.created', 'DESC');
        }
        
        // Get data
        $data = $query->execute()->as_array();
        $total = !empty($data) ? DB::count_last_query(self::$slave_db) : 0;
        
        return array(
            'total' => $total,
            'data' => $data
        );
    }
    
    /**
     * Get detail
     *
     * @author AnhMH
     * @param array $param Input data
     * @return array|bool
     */
    public static function get_detail($param)
    {
        $id = !empty($param['id']) ? $param['id'] : '';
        
        $data = self::find($id);
        if (empty($data)) {
            self::errorNotExist('post_id');
            return false;
        }
        
        return $data;
    }
    
    /**
     * Enable/Disable
     *
     * @author AnhMH
     * @param array $param Input data
     * @return int|bool User ID or false if error
     */
    public static function disable($param)
    {
        $ids = !empty($param['id']) ? $param['id'] : '';
        $disable = !empty($param['disable']) ? $param['disable'] : 0;
        if (!is_array($ids)) {
            $ids = explode(',', $ids);
        }
        foreach ($ids as $id) {
            $self = self::find($id);
            if (!empty($self)) {
                $self->set('disable', $disable);
                $self->save();
            }
        }
        return true;
    }
    
    /**
     * Get all
     *
     * @author AnhMH
     * @param array $param Input data
     * @return array|bool
     */
    public static function get_all($param)
    {
        // Init
        $adminId = !empty($param['admin_id']) ? $param['admin_id'] : '';
        
        // Query
        $query = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(self::$_table_name)
            ->join('cates', 'LEFT')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
            ->where(self::$_table_name.'.disable', 0)
        ;
                        
        // Filter
        if (!empty($param['name'])) {
            $query->where(self::$_table_name.'.name', 'LIKE', "%{$param['name']}%");
        }
        if (!empty($param['cate_id'])) {
            if (!is_array($param['cate_id'])) {
                $param['cate_id'] = array($param['cate_id']);
            }
            $query->where(self::$_table_name.'.cate_id', 'IN', $param['cate_id']);
        }
        
        // Pagination
        if (!empty($param['page']) && $param['limit']) {
            $offset = ($param['page'] - 1) * $param['limit'];
            $query->limit($param['limit'])->offset($offset);
        }
        
        // Sort
        if (!empty($param['sort'])) {
            if (!self::checkSort($param['sort'])) {
                self::errorParamInvalid('sort');
                return false;
            }

            $sortExplode = explode('-', $param['sort']);
            if ($sortExplode[0] == 'created') {
                $sortExplode[0] = self::$_table_name . '.created';
            }
            $query->order_by($sortExplode[0], $sortExplode[1]);
        } else {
            $query->order_by(self::$_table_name . '.created', 'DESC');
        }
        
        // Get data
        $data = $query->execute()->as_array();
        
        return $data;
    }
    
    /**
     * Get home data
     *
     * @author AnhMH
     * @param array $param Input data
     * @return array|bool
     */
    public static function get_home_data($param)
    {
        // Init
        $result = array();
        
        // Get home slider
        $result['sliders'] = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(self::$_table_name)
            ->join('cates', 'LEFT')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
            ->where(self::$_table_name.'.is_home_slide', 1)
            ->where(self::$_table_name.'.disable', 0)
            ->limit(4)
            ->execute()
            ->as_array()
        ;
        
        // Get posts data
        $result['posts'] = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(DB::expr("
                (
                    SELECT
			posts.*,
			@rn :=
                            IF (@prev = cate_id, @rn + 1, 1) AS rn,
                        @prev := cate_id
                    FROM
                        posts
                    JOIN (SELECT @prev := NULL, @rn := 0) AS vars
                    WHERE
                        disable = 0
                        AND is_hot = 0
                        AND is_home_slide = 0
                    ORDER BY
                        cate_id
                ) AS posts
            "))
            ->join('cates', 'LEFT')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
            ->where(DB::expr("rn <= 6"))
            ->execute()
            ->as_array()
        ;
        
        $result['latest_posts'] = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(self::$_table_name)
            ->join('cates', 'LEFT')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
            ->where(self::$_table_name.'.disable', 0)
            ->order_by(self::$_table_name.'.created', 'DESC')
            ->limit(6)
            ->execute()
            ->as_array()
        ;
        
        $result['breaking_news'] = DB::select(
                self::$_table_name.'.*',
                array('cates.name', 'cate_name')
            )
            ->from(self::$_table_name)
            ->join('cates', 'LEFT')
            ->on('cates.id', '=', self::$_table_name.'.cate_id')
            ->where(self::$_table_name.'.disable', 0)
            ->where(self::$_table_name.'.is_hot', 1)
            ->order_by(self::$_table_name.'.created', 'DESC')
            ->limit(4)
            ->execute()
            ->as_array()
        ;
        
        // Return data
        return $result;
    }
}
