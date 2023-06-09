<?php

namespace App;

use PDO;

class User
{
	protected $id;
	protected $first_name;
	protected $last_name;
	protected $email;
	protected $pass;
	protected $created_at;
	protected $birthdate;
	protected $gender;
	protected $address;
	protected $contact;

	public function getId()
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getBirth()
	{
		return $this->birthdate;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function getAddress()
	{
		return $this->address;
	}
	public function getContact()
	{
		return $this->contact;
	}

	public static function getById($id)
	{
		global $conn;

		try {
			$sql = "
				SELECT * FROM users
				WHERE id=:id
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'id' => $id
			]);
			$result = $statement->fetchObject('App\User');
			return $result;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function attemptLogin($email, $pass)
	{
		global $conn;

		try {
			$sql =
			"
				SELECT * FROM users
				WHERE email=:email
				LIMIT 1
			";
			$statement = $conn->prepare($sql);
			$statement->execute([
				'email' => $email,
			]);
			$output=$statement->fetchAll(PDO::FETCH_ASSOC);
			$hashed_password=$output[0]["pass"];

				$sql =
				"
					SELECT * FROM users
					WHERE email=:email
					LIMIT 1
				";
				$statement = $conn->prepare($sql);
				$statement->execute([
					'email' => $email,
				]);
			
				if (password_verify($pass, $hashed_password)){
					$result = $statement->fetchObject('App\User');
				}
					
				else {
					$result = false;
				}
					return $result;
				

		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return null;
	}

	public static function register($first_name, $last_name, $email, $password, $birthdate, $gender, $address, $contact)
	{
		global $conn;
			$password2 = password_hash($password, PASSWORD_BCRYPT);
		try {
			$sql =
			"
				INSERT INTO users (first_name, last_name, email, pass, birthdate, gender, address, contact)
				VALUES ('$first_name', '$last_name', '$email', '$password2', '$birthdate', '$gender', '$address', '$contact')
			";
			$conn->exec($sql);
			// echo "<li>Executed SQL query " . $sql;
			return $conn->lastInsertId();
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}

	public static function registerMany($users)
	{
		global $conn;

		try {
			foreach ($users as $user) {
				$sql = "
					INSERT INTO users
					SET
						first_name=\"{$user['first_name']}\",
						last_name=\"{$user['last_name']}\",
						email=\"{$user['email']}\",
						pass=\"{$user['pass']}\"
				";
				$conn->exec($sql);
				// echo "<li>Executed SQL query " . $sql;
			}
			return true;
		} catch (PDOException $e) {
			error_log($e->getMessage());
		}

		return false;
	}	
}