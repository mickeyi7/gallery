<?php

class User
{

	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;

    public static function find_all_users()
    {
        /*global $database;
          $result_set = $database->query("select * from users");
          return $result_set;*/
          return self::find_this_query("select * from users");
    }

    
    public static function find_user_by_id($user_id)
    {
        global $database;
        
       $the_result_array =  self::find_this_query("select * from users where id = $user_id limit 1");
       return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result_set =  $database->query($sql);
        /*a. we create an empty array to put our objects in there */
        $the_object_array = array();
        /*b. then we create our loop that fetches  our database via mysqli_fetch_array  our table 
          and brings back the $result_set  */
        while($row = mysqli_fetch_array($result_set))
        {
               /*d. then we get those results through the instantiation($the_record) below
                that loops through the columns and records and assign those to our object properties 
                $row['username'] .  "<br>";.........$the_object->username
                in other words we replacing username  (property) value and $row (object) with 
                   */
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    }
    
    public static function verify_user($username,$password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE ";
		$sql .= "username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
      


        $the_result_array =  self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }





    /*a.we get the record from the database 
      e.g. 
            i)  $found_user = User::find_user_by_id(3);
            ii) $user =  User::instantiation($found_user)
      here we find the user's id via the find_user_by_id() function in user class
      that takes the parameter of 3 as the user's id and with its turn calls 
      find_this_query() function with the query as its parameter and this function call 
      the query() function that is on the database class that uses the databse connection's
      constants to return the result that we ask back with find_user_by_id
      then through (ii) we get those results through the instantiation($the_record) below
      that loops through the columns and records and assign those to our object properties 
      */
      /*in a nutshell instantiation() brings back the object's together with its properties to  $the_object_array[]
        in function find_this_query($sql)...which then is return back for further use as an array from a regular loop
        with the view to find our objects in our database table */
    public static function instantiation($the_record)
    {
        $the_object = new self();
        /*b. we loop through the record getting the key ($the_attribute) and the value out of it*/
        foreach($the_record as $the_attribute => $value)
        {
            /*c.here we tell if the object has the attribute by passing it the key e.g. $the_attribute that
                 assigned as the property of the record inside the loop above*/
         if($the_object->has_the_attribute($the_attribute))
         {
             /*d.we assign the $value to the object property (the_attribute) */
              $the_object->$the_attribute = $value;
         }
        }
        return $the_object;
    }
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        /*if  $the_attribute exists in $object_ properties (of this class) that are fetched 
        via get_object_vars($this); which is a function that brings every property of this class private or not
        and refereed to the user class with the $this keyword */
        return array_key_exists($the_attribute,$object_properties);
    }

public function create()
{
    global $database;
    $sql = "insert into users (username,password,firstname,lastname)";
    $sql .= "values ('";
    $sql .= $database->escape_string($this->username)."','";
    $sql .= $database->escape_string($this->password)."','";
    $sql .= $database->escape_string($this->firstname)."','";
    $sql .= $database->escape_string($this->lastname)."')";
    
    if($database->query($sql))
    {
     
        /*the_insert_id() will be responsible to pull the id of the last 
          query and the we are going to assign that ($database->the_insert_id()) to $this->id   */
    $this->id = $database->the_insert_id();
     return true;
    }
    else 
    {
      return false;
    }
}//create method

public function update()
{
    global $database;
   
  
    $sql = "update users set ";
    $sql .= "username= '" . $database->escape_string($this->username)   . "', ";
    $sql .= "password= '" . $database->escape_string($this->password)   . "', ";
    $sql .= "firstname= '" . $database->escape_string($this->firstname) . "', ";
    $sql .= "lastname= '" . $database->escape_string($this->lastname)   . "'  ";
    $sql .= " where id= " . $database->escape_string($this->id);

    $database->query($sql);

    return (mysqli_affected_rows($database->connection)==1) ? true : false;
    
}

public function delete()
{
    global $database;

    $sql = "delete from users ";
    $sql .= " where id = " . $database->escape_string($this->id);
    $sql .= " limit 1 ";
    $database->query($sql);

    return (mysqli_affected_rows($database->connection)==1) ? true : false;
}


}//end class user

?>