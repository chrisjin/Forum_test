<?php

/**
 * thread short summary.
 *
 * thread description.
 *
 * @version 1.0
 * @author C
 */
class ForumThreadModel extends Model
{
    public function GetThreadBySubsectionID($subid)
    {
        $threads = $this->db->query("SELECT * FROM thread WHERE subsection_id='$subid'");
        return $threads;
    }
    public function AddThread($title, $content, $subsectionid, $userid)
    {
        $time = TimeUtil::TimeStamp();
        
        $this->db->query("INSERT INTO thread 
        (title, create_time,lastreply, subsection_id, user_id) 
        VALUES ('$title', '$time', '$time', '$subsectionid', '$userid')");
        $lastid = $this->db->getLastId();
        $this->AddPost($content, $lastid, $userid, true);
    }
    public function GetThreadByID($threadid)
    {
        $threads = $this->db->query("SELECT * FROM thread WHERE thread_id='$threadid'");
        return $threads;
    }
    public function GetPostByThreadID($threadid)
    {
        $posts = $this->db->query("SELECT * FROM post WHERE thread_id='$threadid'");
        return $posts;
    }
    //public function GetPostWithRowNumber($threadid, $offset, $limit)
    //{
    //    $posts = $this->db->query("SET @row_number = 0;
    //    SELECT (@row_number:=@row_number + 1) AS row, thread_id
    //    FROM post WHERE thread_id='$threadid' LIMIT $limit OFFSET $offset");
    //    return $posts;
    //}
    public function GetPostByRange($threadid, $offset, $limit)
    {
        $posts = $this->db->query("SELECT * FROM post WHERE thread_id='$threadid' ORDER BY post_time ASC LIMIT $limit OFFSET $offset");
        return $posts;
    }
    public function AddPost($content, $threadid, $userid, $isop = false)
    {
        $time = TimeUtil::TimeStamp();
        $this->db->query("INSERT INTO post 
        (isop, content, post_time, thread_id, user_id) VALUES
        ('$isop', '$content', '$time', '$threadid', '$userid')");       
    }
    public function GetNumPostByThreadID($threadid)
    {
        $posts = $this->db->query("SELECT count(*) FROM post WHERE thread_id='$threadid'")->row;
        return $posts['count(*)'];
    }
}
