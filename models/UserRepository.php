<?php
/*
 * Userリポジトリ
 */
class UserRepository extends DbRepository
{
	/*
	 * パスワードをハッシュ化し、テーブルへinsertする処理
	 */
	public function insert($user_name, $password)
	{
		$password = $this->hashPassword($password);
		$now = new DateTime();
		
		$sql = "
			INSERT INTO user(user_name, password, created_at)
			VALUES(:user_name, :password, :created_at)
		";
		
		$stmt = $this->execute($sql, array(
			':user_name'  => $user_name,
			':password'   => $password,
			':created_at' => $now->format('Y-m-d H:i:s'),
		));
	}
	/*
	 * パスワードをハッシュ化して返却する処理
	 */
	public function hashPassword($password)
	{
		return sha1($password . 'PasswordHashTz');
	}
	/*
	 * user_nameを条件に対象レコードを取得する処理
	 */
	public function fetchByUserName($user_name)
	{
		$sql = "SELECT * FROM user WHERE user_name = :user_name";
		
		return $this->fetch($sql, array(':user_name' => $user_name));
	}
	/*
	 * user_nameを条件にテーブルにデータが存在しないかチェックする処理
	 */
	public function isUniqueUserName($user_name)
	{
		$sql = "SELECT COUNT(id) as count FROM user WHERE user_name = :user_name";
		
		$row = $this->fetch($sql, array(':user_name' => $user_name));
		if ($row['count'] === '0'){
			return true;
		}
		
		return false;
	}
}