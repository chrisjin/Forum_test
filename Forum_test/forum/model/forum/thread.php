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
        $this->AddPost($title, $content, $lastid, $userid, true);
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
    public function AddPost($title, $content, $threadid, $userid, $isop = false)
    {
        $time = TimeUtil::TimeStamp();
        $this->db->query("INSERT INTO post 
        (isop, title, content, post_time, thread_id, user_id) VALUES
        ('$isop', '$title', '$content', '$time', '$threadid', '$userid')");       
    }
}
