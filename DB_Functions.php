<?php

    // ListAllPeople() - return an array of phone objects
    // USAGE: $peoplelist = ListAllPeople($dbh)
    // $dbh is database handle
    function ListAllProducts($dbh)
    {
        try {
            $query = "SELECT UPC, Pname, price, amount, Sname FROM product order by Pname";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;

            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in ListAllProducts()": ' . $e->getMessage() );
        }
    }

    function ListMatchingPerson($dbh, $name, $city)
    {
        try {
            $person_query = "SELECT * FROM customer where Fname = :name and Lname = :city";
            $stmt = $dbh->prepare($person_query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':city', $city);
            $stmt->execute();
            $persondata = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;

            return $persondata;
        }
        catch(PDOException $e)
        {
            die ('PDO error in ListMatchingPerson()": ' . $e->getMessage() );
        }
    }

    function listProductInfo($dbh, $UPC)
    {
        try {
            $query = "SELECT UPC, Pname, price, amount, Sname FROM product where UPC = :UPC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }
    
    function orderInfo($dbh, $customerID, $orderID)
    {
        try {
            $query = "SELECT Pname, price, quantity, UPC from product join contains using(UPC) join orders using(orderID) where customerID=:customerID and orderID=:orderID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function summaryOrderInfo($dbh, $customerID, $orderID)
    {
        try {
            $query = "SELECT sum(price) as sumPrice, sum(quantity) as sumQuantity from product join contains using(UPC) join orders using(orderID) where customerID=:customerID and orderID=:orderID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function authenticateUser($dbh, $customerID, $Fname, $Lname)
    {
        try {
            $query = "SELECT customerID from customer where customerID=:customerID and Fname=:Fname and Lname=:Lname";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':Fname', $Fname);
            $stmt->bindParam(':Lname', $Lname);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function insertNewCustomer($dbh, $Fname, $Lname, $Address, $City, $State, $Zip)
    {
        try {
            $query = "INSERT into customer(Fname, Lname, address, city, state, zip) values (:Fname, :Lname, :Address, :City, :State, :Zip);";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':Fname', $Fname);
            $stmt->bindParam(':Lname', $Lname);
            $stmt->bindParam(':Address', $Address);
            $stmt->bindParam(':City', $City);
            $stmt->bindParam(':State', $State);
            $stmt->bindParam(':Zip', $Zip);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function getNewCustomerID($dbh, $Fname, $Lname, $Address, $City, $State, $Zip)
    {
        try {
            $query = "SELECT customerID from customer where Fname=:Fname and Lname=:Lname and address=:Address and city=:City and state=:State and zip=:Zip;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':Fname', $Fname);
            $stmt->bindParam(':Lname', $Lname);
            $stmt->bindParam(':Address', $Address);
            $stmt->bindParam(':City', $City);
            $stmt->bindParam(':State', $State);
            $stmt->bindParam(':Zip', $Zip);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function viewWishList($dbh, $customerID)
    {
        try {
            $query = "SELECT Pname, UPC from product where UPC in (select UPC from wishes where customerID=:customerID) order by Pname";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function addToWishList($dbh, $customerID, $UPC)
    {
        try {
            $query = "INSERT into wishes(customerID, UPC) values (:customerID, :UPC);";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function removeFromWishList($dbh, $customerID, $UPC)
    {
        try {
            $query = "DELETE from wishes where customerID=:customerID and UPC=:UPC;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function removeFromOrderCart($dbh, $orderID, $UPC)
    {
        try {
            $query = "DELETE from contains where orderID=:orderID and UPC=:UPC;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function customerName($dbh, $customerID)
    {
        try {
            $query = "SELECT Fname, Lname from customer where customerID=:customerID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function addCustomerRating($dbh, $customerID, $UPC, $rating, $ratingdate)
    {
        try {
            $query = "INSERT into rated(customerID, UPC, rating, ratingdate) values (:customerID, :UPC, :rating, :ratingdate);";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':ratingdate', $ratingdate);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function getCustomerRating($dbh, $customerID, $UPC)
    {
        try {
            $query = "SELECT * from rated where customerID=:customerID and UPC=:UPC;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function avgProdRating($dbh, $UPC)
    {
        try {
            $query = "select avg(rating) as avgRating, count(rating) as numReviews from rated join product using(UPC) where UPC=:UPC;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function decrementProdAmount($dbh, $UPC, $amount)
    {
        try {
            $query = "update product set amount = amount - :amount where UPC=:UPC;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function countNumProdInOrder($dbh, $orderID)
    {
        try {
            $query = "SELECT count(UPC) as count from contains join orders using(orderID) where orderID=:orderID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function createOrder($dbh, $customerID)
    {
        try {
            $query = "INSERT into orders(customerID, orderdate, shipdate, payment_type, CCN) values (:customerID, NULL, NULL, NULL, NULL);";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function getCurrentOrderNumber($dbh, $customerID)
    {
        try {
            $query = "SELECT max(orderID) as orderID from orders where customerID=:customerID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':customerID', $customerID);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function addItemsToOrder($dbh, $orderID, $UPC, $quantity)
    {
        try {
            $query = "INSERT into contains(orderID, UPC, quantity) values (:orderID, :UPC, :quantity);";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->bindParam(':UPC', $UPC);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

    function finalizeOrder($dbh, $orderID, $orderDate, $paymentType, $CCN)
    {
        try {
            $query = "UPDATE orders set orderdate=:orderDate, payment_type=:paymentType, CCN=:CCN where orderID=:orderID;";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(':orderID', $orderID);
            $stmt->bindParam(':orderDate', $orderDate);
            $stmt->bindParam(':paymentType', $paymentType);
            $stmt->bindParam(':CCN', $CCN);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt = null;
            return $data;
        }
        catch(PDOException $e)
        {
            die ('PDO error in listProductInfo()": ' . $e->getMessage() );
        }
    }

?>