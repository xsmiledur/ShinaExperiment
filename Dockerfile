FROM php:apache
COPY ./public/index.php /var/www/html/

FROM centos
MAINTAINER Yuri Mikawa

RUN echo "now building..."

RUN yum -y update

RUN yum -y install httpd

# EPELリポジトリ
RUN yum -y install epel-release

# Remiリポジトリ
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

# php7.0
RUN yum -y install --enablerepo=remi,remi-php70 php php-devel php-mbstring php-pdo php-gd php-mysql php-psgsql php-xml

RUN yum -y install --enablerepo=epel,remi-php70,remi php php-cli php-gd php-mbstring php-mcrypt php-xml php-mysqlnd php-pdophp-xml php-memcached

COPY build/httpd.conf /etc/httpd/conf
COPY build/php.ini /etc

RUN mkdir -p /var/www
RUN mkdir -p /var/public
RUN mkdir -p /var/application
RUN mkdir -p /var/public/uploads

# Add files from WWW folder
COPY public /var/www/public

RUN chmod 775 /var/www/public/uploads

# Do some web maping
VOLUME ["/var/www"]

EXPOSE 80

CMD ["/usr/sbin/httpd","-D","FOREGROUND"]