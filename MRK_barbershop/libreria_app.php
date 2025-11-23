<?php
// Parametri di connessione al database
define("DB_HOST", "localhost");
define("DB_NAME", "barber_shop");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// Definizione degli slot disponibili e dei limiti temporali
define("APPO_SLOT", [
  "10:00/10:30","10:30/11:00","11:00/11:30","11:30/12:00",
  "12:00/12:30","12:30/13:00","14:00/14:30","14:30/15:00"
]);
define("APPO_MIN", 0); // giorno odierno
define("APPO_MAX", 7); // ultimo giorno prenotabile

class Appointment {
  private $pdo = null;
  private $stmt = null;
  public $error = "";

  // Costruttore: connessione al database
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]
    );
  }

  // Distruttore: chiusura connessione
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // Funzione generica per eseguire query
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // Recupera appuntamenti tra due date
  function get ($da, $a) {
    $this->query(
      "SELECT * FROM `appointments` WHERE `appo_date` BETWEEN ? AND ?",
      [$da, $a]
    );
    $res = [];
    while ($r = $this->stmt->fetch()) {
      $res[$r["appo_date"]][$r["appo_slot"]] = $r["email"];
    }
    return $res;
  }

  // Salva un nuovo appuntamento
  function save ($date, $slot, $email) {
    $min = strtotime("+".APPO_MIN." day");
    $max = strtotime("+".APPO_MAX." day");
    $unix = strtotime($date);

    // Controllo validità della data
    if ($unix < $min || $unix > $max) {
      $this->error = "La data deve essere compresa tra il giorno ".date("Y-m-d", $min)." ed il giorno ".date("Y-m-d", $max);
      return false;
    }

    // Controllo se lo slot è già occupato
    $this->query(
      "SELECT * FROM `appointments` WHERE `appo_date`=? AND `appo_slot`=?",
      [$date, $slot]
    );
    if (is_array($this->stmt->fetch())) {
      $this->error = "$date $slot è già prenotata";
      return false;
    }

    // Inserimento nuovo appuntamento
    $this->query(
      "INSERT INTO `appointments` (`appo_date`, `appo_slot`, `email`) VALUES (?,?,?)",
      [$date, $slot, $email]
    );

    return true;
  }
}

// Creazione oggetto Appointment
$_APPO = new Appointment();
?>
