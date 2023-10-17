<?php 
/* 
 * JSON Class 
 * This class is used for json file related (connect, insert, update, and delete) operations
 */ 
class Json{ 
    private $jsonFile = "json_files/data.json"; 
     
 
    public function getRows(){ 
        if(file_exists($this->jsonFile)){ 
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            if(!empty($data)){ 
                usort($data, function($a, $b) { 
                    return $b['id'] - $a['id']; 
                }); 
            } 
             
            return !empty($data)?$data:false; 
        } 
        return false; 
    } 
     
    public function getSingle($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
        $singleData = array_filter($data, function ($var) use ($id) { 
            return (!empty($var['id']) && $var['id'] == $id); 
        }); 
        $singleData = array_values($singleData)[0]; 
        return !empty($singleData)?$singleData:false; 
    } 
    //Insert function 
    public function insert($newData){ 
        if(!empty($newData)){ 
            $id = time(); 
            $newData['id'] = $id; 
             
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            $data = !empty($data)?array_filter($data):$data; 
            if(!empty($data)){ 
                array_push($data, $newData); 
            }else{ 
                $data[] = $newData; 
            } 
            $insert = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $insert?$id:false; 
        }else{ 
            return false; 
        } 
    } 
    // Update Function 
    public function update($upData, $id){ 
        if(!empty($upData) && is_array($upData) && !empty($id)){ 
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            foreach ($data as $key => $value) { 
                if ($value['id'] == $id) { 
                    if(isset($upData['image_url'])){ 
                        $data[$key]['image_url'] = $upData['image_url']; 
                    } 
                    if(isset($upData['mem_name'])){ 
                        $data[$key]['mem_name'] = $upData['mem_name']; 
                    } 
                    if(isset($upData['link_url'])){ 
                        $data[$key]['link_url'] = $upData['link_url']; 
                    } 
                    if(isset($upData['profile'])){ 
                        $data[$key]['profile'] = $upData['profile']; 
                    }
                    if(isset($upData['mem_des'])){ 
                        $data[$key]['mem_des'] = $upData['mem_des']; 
                    } 
                    // if(isset($upData['publish_date'])){ 
                    //     $data[$key]['publish_date'] = $upData['publish_date']; 
                    // }
                } 
            } 
            $update = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $update?true:false; 
        }else{ 
            return false; 
        } 
    } 
    // Delete Function 
    public function delete($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
             
        $newData = array_filter($data, function ($var) use ($id) { 
            return ($var['id'] != $id); 
        }); 
        $delete = file_put_contents($this->jsonFile, json_encode($newData)); 
        return $delete?true:false; 
    } 
}