abrir vagrant
modificar fichero c:\windows\system32\drivers\etc\hosts

    127.0.0.1 www.dondecomerzgz.com
    127.0.0.1 www.dondecomermad.com
    127.0.0.1 www.dondecomerbcn.com
    127.0.0.1 www.dondecomerval.com
    127.0.0.1 www.dondecomermur.com


crear fichero bootstrap.sh

    config.vm.provision :shell, path:"bootstrap.sh"
    config.vm.network :forwarded_port,guest:80,host:80
    config.vm.network :forwarded_port,guest:443,host:4501

vagrant init bento/ubuntu-20.04
vagrant up --provision
vagrant ssh

apt update
apt install apache2 libapache2-mod-php php php-mysql
apt install php-curl php-gd php-xml php-xmlrpc php-zip php-soap php-intl
apt install mysql-server
apt install php7.4-mysqli
apt install phpmyadmin php-mbstring    root / Zaragoza.789
phpenmod mbstring

mysql -p -u root
    CREATE USER 'david'@'%' IDENTIFIED BY 'qwerty';
    GRANT ALL PRIVILEGES ON *.* TO 'david'@'%' WITH GRANT OPTION;

Crear base de datos dondecomer
Crear tabla ciudades con campos url, nombreCiudad, codigoCiudad
    Valores.    

INSERT INTO `ciudades` (`url`, `nombreCiudad`, `codigoCiudad`) VALUES ('www.dondecomermad.com/', 'Madrid', 'MAD');
INSERT INTO `ciudades` (`url`, `nombreCiudad`, `codigoCiudad`) VALUES ('www.dondecomerzgz.com/', 'Zaragoza', 'ZGZ');
INSERT INTO `ciudades` (`url`, `nombreCiudad`, `codigoCiudad`) VALUES ('www.dondecomerbcn.com/', 'Barcelona', 'BCN');
INSERT INTO `ciudades` (`url`, `nombreCiudad`, `codigoCiudad`) VALUES ('www.dondecomerval.com/', 'Valencia', 'VAL');
INSERT INTO `ciudades` (`url`, `nombreCiudad`, `codigoCiudad`) VALUES ('www.dondecomermur.com/', 'Murcia', 'MUR');


service apache2 restart

