<?php
/**
 * 过滤用户输入的评论信息
 * User: maosilu
 * Date: 2017/11/1
 * Time: 下午3:10
 */
class Comment
{
    private $_data = array();

    public function __construct($data){
        $this->_data = $data;
    }

    /**
     * 检测用户输入内容，使用PHP内置的过滤方法：filter_input
     * @param array $arr
     * @return boolen
    */
    public static function validate(&$arr){
        if(!($data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
            $errors['email'] = '请输入合法邮箱';
        }
        if(!($data['url'] = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL))){
            $url = '';
        }
        if(!($data['content'] = filter_input(INPUT_POST, 'content', FILTER_CALLBACK, array('options'=>'Comment::validate_str')))){
            $errors['content'] = '请输入合法内容';
        }
        if(!($data['username'] = filter_input(INPUT_POST, 'username', FILTER_CALLBACK, array('options'=>'Comment::validate_str')))){
            $errors['username'] = '请输入合法的用户名';
        }
        $options = array(
            'options' => array(
                'min_range' => 1,
                'max_range' => 5
            ),
        );
        if(!($data['face'] = filter_input(INPUT_POST, 'face', FILTER_VALIDATE_INT, $options))){
            $errors['face'] = '请选择合法头像';
        }

        if(!empty($errors)){
            $arr = $errors;
            return false;
        }
        $arr = $data;
        $arr['email'] = trim($arr['email']);
        return true;
    }

    /**
     * 过滤用户输入的特殊字符
     * @param string $str
     * @return string $str
    */
    public static function validate_str($str){
        if(mb_strlen($str, 'utf-8') < 1){
            return false;
        }
        $str = nl2br(htmlspecialchars($str, ENT_QUOTES));
        return $str;
    }

    /**
     * 显示评论内容
    */
    public function output(){
        $link_start = '';
        $link_end = '';
        if($this->_data['url']){
            $link_start = "<a href='{$this->_data['url']}' target='_blank'>";
            $link_end = "</a>";
        }
        $dateStr = date('Y-m-d H:i:s', $this->_data['pubTime']);
        $res = <<<EOF
            <div class='comment'>
                <div class='face'>{$link_start}<img width='50' height='50' src='img/{$this->_data['face']}.jpg'/>{$link_end}</div>
                <div class='username'>{$link_start}{$this->_data['username']}{$link_end}</div>
                <div class='pubtime' title='发布于{$dateStr}'>{$dateStr}</div>
                <p>{$this->_data['content']}</p>
            </div>
EOF;
                return $res;

    }
}