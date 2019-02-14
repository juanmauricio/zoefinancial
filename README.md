# zoefinancial

## Characteristics

1. Makes use of the user managament scaffold provided by lavarel (Registration, Authentication, LogOut).
2. Agents and contacts are identified based on wether they choose a profession when registering (NONE for contacts, Agents otherwise).
3. At the moment of registration, based on the zip code provided, the system consumes the Geocoding API by google to obtain the geographic coordinates based on the zipcode).  Logic: app\Http\Controllers\Auth\RegisterController.php

https://maps.googleapis.com/maps/api/geocode/json?address=47722&key=xxxxxxwlLpLQe1jJErxxxxOLBK1xxxxxx

The whole information (it could be very useful...) returned is saved in the database, extracting the lat and lng to their own database fields for later use.

Response example (zip code: 47722)

{
   "results" : [
      {
         "address_components" : [
            {
               "long_name" : "47722",
               "short_name" : "47722",
               "types" : [ "postal_code" ]
            },
            {
               "long_name" : "Lincolnshire",
               "short_name" : "Lincolnshire",
               "types" : [ "neighborhood", "political" ]
            },
            {
               "long_name" : "Evansville",
               "short_name" : "Evansville",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Knight Township",
               "short_name" : "Knight Township",
               "types" : [ "administrative_area_level_3", "political" ]
            },
            {
               "long_name" : "Vanderburgh County",
               "short_name" : "Vanderburgh County",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Indiana",
               "short_name" : "IN",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "United States",
               "short_name" : "US",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Evansville, IN 47722, USA",
         "geometry" : {
            "location" : {
               "lat" : 37.9700012,
               "lng" : -87.5422973
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 37.97135018029149,
                  "lng" : -87.54094831970851
               },
               "southwest" : {
                  "lat" : 37.9686522197085,
                  "lng" : -87.54364628029151
               }
            }
         },
         "place_id" : "ChIJb0zVNaMqbogRxzMASWuYnfg",
         "types" : [ "postal_code" ]
      }
   ],
   "status" : "OK"
}

When an Agent logs in the system a link `find matches` will be displayed. It will list the matches by distance (miles) in ascending order. Logic: app\Http\Controllers\UsersController.php

Example:

Id	Name	Last name	Distance
10	JUAN M  LOPEZ   	54.465664752528
1	Juan	NNN	        6084.2544909246
2	JUAN    LOPEZ   	6084.2544909246


## Requirements
1. Homestead development envrironment configured (keys, folders, sites and database).

## Installing
1. Clone this repository.
2. Run `php composer install` to install project dependencies on the project folder.
3. Run `vagrant up` command on the project folder.
4. Run `php artisan migrate` command on the project folder to install MySql database (default credentials, PORT: 33060).
5. Edit your .hosts file to  include homestead.test pointing to the local host.
