<?php
class Country {
	private $countryCode, $countryName;

	public function __construct($countryCode, $countryName) {
		$this->countryCode = $countryCode;
		$this->countryName = $countryName;
	}

	public function getCountryCode() {
		return $this->countryCode;
	}

	public function getCountryName() {
		return $this->countryName;
	}

}

class CountryDB {
	public static function get_countries() {
		$db = Database::getDB();
        $query = 'SELECT * FROM countries';
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        $countries = array();
        foreach ($result as $row) {
            $country = new Country(
                $row['countryCode'],
                $row['countryName']
            );

            $countries[] = $country;
        }
        return $countries;
	}
}