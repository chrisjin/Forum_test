<?php

/**
 * section short summary.
 *
 * section description.
 *
 * @version 1.0
 * @author C
 */
class ForumSectionModel extends Model
{
    public function GetAllSections()
    {
        $section = $this->db->query('SELECT * FROM section');
        return $section;
    }
    public function GetSectionByID($sectionid)
    {
        $section = $this->db->query("SELECT * FROM section WHERE section_id='$sectionid'");
        return $section;  
    }
    public function GetSubsectionByID($subsectionid)
    {
        $section = $this->db->query("SELECT * FROM subsection WHERE subsection_id='$subsectionid'");
        return $section;     
    }
    public function GetSubsectionsByParentID($parentid)
    {
        $section = $this->db->query("SELECT * FROM subsection WHERE section_id='$parentid'");
        return $section;   
    }
    public function GetForumStructure()
    {
        $sectionids = $this->db->query('SELECT section_id FROM section')->rows;
        
        $structure = [];
        foreach($sectionids as $id)
        {
            $idstr = $id['section_id'];
            $subsection = $this->db->query("SELECT * FROM subsection WHERE section_id='$idstr'");
            $structure[$idstr] = $subsection->rows;
        }
        
        return $structure;
        
    }
    public function GetSubsectionBy()
    {
        $subsection = $this->db->query('SELECT * FROM section');
        return $subsection;
    }

}
