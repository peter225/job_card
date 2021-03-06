<?php

class Job 
{
    protected $ownerID;
	protected $jobID;
	protected $title;
	protected $deviceDescription;
	protected $deviceID;
    protected $ownerName;
    protected $ownerPhoneNumber;
	protected $fault;
    protected $jobPrice;
    protected $pricePaid;
	protected $deviceName;
    protected $status;
    protected $balance;
	protected $dbInstance;
    protected $searchString;

	public function setDBInstance( PDO $dbInstance )
	{
		$this->dbInstance = $dbInstance;
	}

	public function getDBInstance()
	{
		return $this->dbInstance;
	}

	public function setJobID( $jobID )
	{
		$this->jobID = $jobID;
	}

	public function getJobID()
	{
		return $this->jobID;
	}
    public function setOwnerID( $ownerID )
    {
        $this->ownerID = $ownerID;
    }

    public function getOwnerID()
    {
        return $this->ownerID;
    }

    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    public function getOwnerName()
    {
        return $this->ownerName;
    }

    public function setOwnerPhone($ownerPhoneNumber)
    {
        $this->ownerPhone = $ownerPhoneNumber;
    }

    public function getOwnerPhone()
    {
        return $this->ownerPhone;
    }

    public function search( Admin $admin )
    {
        try
        {
               if(isset($_POST['search-btn']))
             {
                $lastName = trim($_POST['lastname']);

                $sql = 'SELECT * FROM customer WHERE lastname =:lastName';

                $stmt = $this->dbInstance->prepare($sql);

                $stmt->execute( array(':lastName'=> $lastName) );

                $results = $stmt->fetchAll();

                return $results;
             } 
             else
             {
                echo "No results";
             }
        }
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
             
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
             
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );
             
        }
        catch ( Error $e) 
        {
           throw new Error($e->getMessage() );
             
        }
    }

    public function searchJob( Admin $admin )
    {
        try
        {
            if(isset($_POST['search-btn']))
            {
                $customerId = trim($_POST['customer_id']);

                $sql = 'SELECT * FROM jobs WHERE customer_id =:customerId';

                $stmt = $this->dbInstance->prepare($sql);

                $stmt->execute( array(':customerId'=> $customerId) );

                $results =  $stmt->fetchAll();

                return $results;
            } 
            else
            {
                echo "No results";
            }
        }
        catch (PDOException $e) 
        {
           throw new PDOException($e->getMessage() );
             
        }
        catch (CustomException $e) 
        {
           throw new CustomException( $e->getMessage() );
             
        }
        catch ( Exception $e) 
        {
           throw new Exception($e->getMessage() );
             
        }
        catch ( Error $e) 
        {
           throw new Error($e->getMessage() );
             
        }
    }
    

    public function setTitle( $title )
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setStatus( $status )
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setBalance( $balance )
    {
        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
    }
    
    public function getDeviceName()
    {
        return $this->deviceName;
    }

    public function setDeviceDescription($deviceDescription)
    {
        $this->deviceDescription = $deviceDescription;
    }
    
    public function getDeviceDescription()
    {
        return $this->deviceDescription;
    }

    public function setDeviceID($deviceID)
    {
        $this->deviceID = $deviceID;
    }
    
    public function getDeviceID()
    {
        return $this->deviceID;
    }

    public function setFault( $fault )
    {
        $this->fault = $fault;
    }
    
    public function getFault()
    {
        return $this->fault;
    }

    public function setActualPrice( $jobPrice )
    {
        $this->jobPrice = $jobPrice;
    }
    
    public function getActualPrice()
    {
        return $this->jobPrice;
    }

    public function setAmountPaid( $pricePaid )
    {
        $this->pricePaid = $pricePaid;
    }
    
    public function getAmountPaid()
    {
        return $this->pricePaid;
    }

    public function generateID( $digit )
	{
		$number = "";

        for ($i = 0; $i < $digit; $i++) 
        {
            $number .= mt_rand(0, 9);
        }

		return $number;
	}

	public function IDExists( $jobID )
	{

		$stmt = $this->dbInstance->prepare( 'SELECT COUNT(id) FROM jobs WHERE id = :ID' );

		$stmt->execute( array(':ID'=>$jobID ) );
        
		return ( $stmt->fetchColumn() > 0 );
	}
}	