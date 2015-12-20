# OpenCity Bike WebApp

Aquest repositori inclou la part servidor del projecte client-servidor de OpenCity Bike desenvolupat per a l'assignatura SLDS de la FIB de la Universitat Politècnica de Catalunya.

Aquest projecte té com objectiu facilitar a qualsevol municpi que ho destigi, instal·lar i proveïr als seus habitants un sistema basat en aplicació mòbil per tenir constància de l'estat de les estacions de la seva ciutat, així com mantenir un històric dels trajectes realitzats.

### Descàrrega del projecte
  ````  
git clone https://github.com/OpenBikeBcn/openbikebcn-web.git
  ````  
El servei es pot instal·lar de dues maneres:
  - Entorn virtual Vagrant
  - Instal·lació en un entorn LAMP.

### Mètode 1: Entorn virtual Vagrant (Recomanada)

Cal disposar d'un equip amb Virtualbox i Vagrant instal·lats. Un cop instal·lats aquests i descarregat el projecte, només cal arrancar l'entorn des del directori arrel del projecte:

  ````  
  vagrant up
  ````  
  
### Mètode 2: Instal·lació en un entorn LAMP
Per instal·lar el sistema web del OpenCityBikes abans cal preparar un entorn Linux basat en Debian amb els següents serveis:

  * Servidor web Apache o Nginx amb virtualhost cap a la carpeta /web del source del O

  * Motor PHP carregat al servidor web

  * Client Git

  ````


sudo apt-get install php5-dev php5-cli php-pear

  ````

Instal·lació i configuració del projecte web
--------------------------------------------

  * Descàrrega del gestor de paquets Composer
  ````
curl -s https://getcomposer.org/installer | php
  ````

  * Instal·lació dels Vendors
  ````
php composer.phar install
  ````

  * Configuració de les dades de connexió de la BDD
Editant el fitxer /app/config/parameters.yml del source de OpenCityBikes

  * Configuració dels permisos de app/cache i app/logs
  ````
./init.sh
  ````

  * Creació de la BDD
  ````
php app/console doctrine:database:create
  ````

  * Mapeig de les Entitats a la BDD i refresc
  ````
php app/console doctrine:schema:update --force


Llicència
----
Aquest projecte es publica sota una llicència MIT.

Tecnologies
----
El sistema web està desenvolupat utilitzant el Framework PHP de Symfony versió 2.7 i base de dades MySQL.
Amb els bundles:
> FOSUserBundle 

> FOSRESTBundle

> JMSerializer

Autors del projecte
----
Pau Madrero	<pau.madrero@est.fib.upc.edu>
Alex Morral	<alex.morral@est.fib.upc.edu>
Albert Terrones <albert.terrones@est.fib.upc.edu>
Victor Mateos	<victor.mateos@est.fib.upc.edu>