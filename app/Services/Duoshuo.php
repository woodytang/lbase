<?php


Class Duoshuo {


    $secret = 'd2aa76ac704d92a2d7c1a623c4d1e813';
    $short_name = 'larabase';
    $last_log_id = '上一次同步时读到的最后一条log的ID，开发者自行维护此变量（如保存在你的数据库）。';

    /**
     *
     * 获取评论数据
     *
     */
    function sync_log() {
        if (check_signature($_POST)) {

            $limit = 20;

            $params = array(
                'limit' => $limit,
                'order' => 'asc',
            );


            $posts = array();

            if (!$this->last_log_id)
                $this->last_log_id = 0;

            $params['since_id'] = $this->last_log_id;
            //自己找一个php的 http 库
            $response = $http_client->request('GET', 'http://api.duoshuo.com/log/list.json', $params);

            if (!isset($response['response'])) {
                //处理错误,错误消息$response['message'], $response['code']
                //...

            } else {
                //遍历返回的response，你可以根据action决定对这条评论的处理方式。
                foreach($response['response'] as $log){

                    switch($log['action']){
                        case 'create':
                            //这条评论是刚创建的
                            break;
                        case 'approve':
                            //这条评论是通过的评论
                            break;
                        case 'spam':
                            //这条评论是标记垃圾的评论
                            break;
                        case 'delete':
                            //这条评论是删除的评论
                            break;
                        case 'delete-forever':
                            //彻底删除的评论
                            break;
                        default:
                            break;
                    }

                    //更新last_log_id，记得维护last_log_id。（如update你的数据库）
                    if (strlen($log['log_id']) > strlen($this->last_log_id) || strcmp($log['log_id'], $this->last_log_id) > 0) {
                        $this->last_log_id = $log['log_id'];
                    }

                }


            }


        }
    }

    /**
     *
     * 检查签名
     *
     */
    function check_signature($input){

        $signature = $input['signature'];
        unset($input['signature']);

        ksort($input);
        $baseString = http_build_query($input, null, '&');
        $expectSignature = base64_encode(hmacsha1($baseString, $this->secret));
        if ($signature !== $expectSignature) {
            return false;
        }
        return true;
    }

    // from: http://www.php.net/manual/en/function.sha1.php#39492
    // Calculate HMAC-SHA1 according to RFC2104
    // http://www.ietf.org/rfc/rfc2104.txt
    function hmacsha1($data, $key) {
        if (function_exists('hash_hmac'))
            return hash_hmac('sha1', $data, $key, true);

        $blocksize=64;
        if (strlen($key)>$blocksize)
            $key=pack('H*', sha1($key));
        $key=str_pad($key,$blocksize,chr(0x00));
        $ipad=str_repeat(chr(0x36),$blocksize);
        $opad=str_repeat(chr(0x5c),$blocksize);
        $hmac = pack(
                'H*',sha1(
                        ($key^$opad).pack(
                                'H*',sha1(
                                        ($key^$ipad).$data
                                )
                        )
                )
        );
        return $hmac;
    }

 }
php?>