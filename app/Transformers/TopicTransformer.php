<?php

namespace App\Transformers;

use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'category']; //可以額外嵌套的資源

    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'title' => $topic->title,
            'body' => $topic->body,
            'user_id' => (int) $topic->user_id,
            'category_id' => (int) $topic->category_id,
            'reply_count' => (int) $topic->reply_count,
            'view_count' => (int) $topic->view_count,
            'last_reply_user_id' => (int) $topic->last_reply_user_id,
            'excerpt' => $topic->excerpt,
            'slug' => $topic->slug,
            'created_at' => $topic->created_at->toDateTimeString(),
            'updated_at' => $topic->updated_at->toDateTimeString(),
        ];
    }


    //那麼額外的資源如何獲取，如何轉換，則通過includeUser和includeCategory確定，
    //availableIncludes中的每一個參數都對應一個具體的方法，
    //方法命名規則為 include + user、include + category駝峰命名。
    public function includeUser(Topic $topic)    //在網頁後面加上?include=user就會多顯示user的transformer
    {
        return $this->item($topic->user, new UserTransformer());
    }

    public function includeCategory(Topic $topic)
    {
        return $this->item($topic->category, new CategoryTransformer());
    }

    //$this->item () 返回單個資源 
    //$this->collection () 返回集合資源
}