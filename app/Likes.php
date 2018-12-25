<?php
/**
 * Created by PhpStorm.
 * User: ssa41
 * Date: 2018-12-25
 * Time: 오후 8:56
 */

namespace App;


trait Likes
{
    public function like()
    {
        $like = new Like(['user_id' => auth()->user()->id]);

        $this->likes()->save($like);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->user()->id)->delete();
    }

    public function toggle()
    {
        if($this->isLiked())
            return $this->unlike();

        return $this->like();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLiked()
    {
        return !! $this->likes()
            ->where('user_id', auth()->user()->id)
            ->count();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}