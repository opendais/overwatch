# Overwatch is the overarching project for the following components:
* Authentication [ Very basic. ]
* Dashboard [ Displays the data. ]
* API [ Recieves the data, provides the data to the dashboard ]
* Notifier [ Likely email + email-based sms based on a given metric not recieving data only initially ]
* API Clients [Likely mechanisms for existing data collectors (e.g. StatsD, CollectD) to pass data to the API and therefore stored in seperate projects.]

# Stack Assumption:
* https://github.com/opendais/ubuntu-12.04-chef-solo-bootstrap
* Chef - Purely for deployment
* LEMP Stack + Redis
	* Ubuntu 12.04 LTS [ We currently plan to update with each new LTS release ]
	* NGINX [HTTPS only, so you'll need a SSL cert]
	* PHP
	* MySQL
	* Redis
	* HTML/JS/CSS

