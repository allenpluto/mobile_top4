-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2016 at 06:36 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allen_frame_trial`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entity_category`
--

DROP TABLE IF EXISTS `tbl_entity_category`;
CREATE TABLE IF NOT EXISTS `tbl_entity_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friendly_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `alternate_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `image_id` int(11) NOT NULL DEFAULT '-1',
  `enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keywords` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `scoopit_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `schema_itemtype` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://schema.org/Organization',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=161 ;

--
-- Dumping data for table `tbl_entity_category`
--

INSERT INTO `tbl_entity_category` (`id`, `friendly_url`, `name`, `alternate_name`, `description`, `image_id`, `enter_time`, `update_time`, `keywords`, `content`, `status`, `category_id`, `scoopit_url`, `schema_itemtype`) VALUES
(1, 'corporation', 'Corporation', 'Corporation', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'corporate governance\r\nbody corporate Sydney\r\nbody corporate services', '', 'S', 0, 'corporation-top4', 'http://schema.org/Corporation'),
(2, 'educational-organisation', 'EducationalOrganization', 'Educational Organisation', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'education\r\neducation in Australia\r\neducation jobs', '', 'S', 0, 'educational-organisation-top4', 'http://schema.org/EducationalOrganization'),
(3, 'government-organisation', 'GovernmentOrganization', 'Government Organisation', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'government grants\r\naustralian government organisations\r\ngovernment department in australia', '', 'S', 0, '', 'http://schema.org/GovernmentOrganization'),
(4, 'local-business', 'LocalBusiness', 'Local Business', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'local business search\r\nbusiness directory\r\nlocal directory', '', 'S', 0, '', 'http://schema.org/LocalBusiness'),
(5, 'non-governmental-organisation', 'NGO', 'Non-Governmental Organisation', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'ngo jobs\r\nngo sydney\r\nnon government organisation', '', 'S', 0, '', 'http://schema.org/NGO'),
(6, 'performing-group', 'PerformingGroup', 'Performing Group', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'performing arts group\r\nmajor in performing arts\r\naustralian performing group', '', 'S', 0, '', 'http://schema.org/PerformingGroup'),
(7, 'sports-team', 'SportsTeam', 'Sports Team', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'sports team management\r\naustralian sports teams\r\nsporting teams', '', 'S', 0, '', 'http://schema.org/SportsTeam'),
(8, 'colleges-or-universities', 'CollegeOrUniversity', 'Colleges or Universities', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'university\r\ncollege\r\naustralian universities', '', 'S', 2, 'colleges-or-universities-top4', 'http://schema.org/CollegeOrUniversity'),
(9, 'primary-school', 'ElementarySchool', 'Primary School', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'early childhood education\r\nhomeschooling\r\nteaching jobs', '', 'S', 2, '', 'http://schema.org/ElementarySchool'),
(10, 'high-school', 'HighSchool', 'High School', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'high school tutoring\r\nsydney state high school\r\nhigh school rankings', '', 'S', 2, '', 'http://schema.org/HighSchool'),
(11, 'secondary-school', 'MiddleSchool', 'Secondary School', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'australia middle school\r\neducation\r\nschool', '', 'S', 2, '', 'http://schema.org/MiddleSchool'),
(12, 'pre-school', 'Preschool', 'Pre School', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'preschool teacher\r\nearly childhood teaching\r\npreschools sydney', '', 'S', 2, '', 'http://schema.org/Preschool'),
(13, 'special-school', 'School', 'Special School', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'school jobs\r\nhome schooling\r\nprimary schools', '', 'S', 2, '', 'http://schema.org/School'),
(14, 'animal-shelter', 'AnimalShelter', 'Animal Shelter', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Animal Shelters\r\nPet Rescue\r\nanimal welfare', '', 'S', 4, '', 'http://schema.org/AnimalShelter'),
(15, 'automotive-business', 'AutomotiveBusiness', 'Automotive Business', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Automotive Industry\r\nAutomotive Sales\r\nDealership', '', 'S', 4, 'automotive-business-top4', 'http://schema.org/AutomotiveBusiness'),
(16, 'childcare-services', 'ChildCare', 'Childcare Services ', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Daycare\r\nChild Care \r\nChildcare Centres', '', 'A', 4, 'childcare-services-top4', 'http://schema.org/ChildCare'),
(17, 'dry-cleaners', 'DryCleaningOrLaundry', 'Dry Cleaners', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Home dry cleaning\r\nDry cleaning services\r\nHouse cleaning', '', 'S', 4, 'dry-cleaners-top4', 'http://schema.org/DryCleaningOrLaundry'),
(18, 'emergency-service', 'EmergencyService', 'Emergency Service', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'State Emergency Services\r\nEmergency Services Australia\r\nEmergency services portal', '', 'S', 4, '', 'http://schema.org/EmergencyService'),
(19, 'recruitment-services', 'EmploymentAgency', 'Recruitment Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Employment Agencies\r\nRecruitment Agencies\r\nJob Search', '', 'S', 4, 'recruitment-services-top4', 'http://schema.org/EmploymentAgency'),
(20, 'entertainment-business', 'EntertainmentBusiness', 'Entertainment Business', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Entertainment Industry\r\nEntertainment Agency\r\nEntertainment Club', '', 'S', 4, 'entertainment-business-top4', 'http://schema.org/EntertainmentBusiness'),
(21, 'financial-services', 'FinancialService', 'Financial Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Financial Services\r\nFinancial Service providers\r\nFinancial Planning Services', '', 'S', 4, 'financial-services-top4', 'http://schema.org/FinancialService'),
(22, 'food-establishment', 'FoodEstablishment', 'Food Establishment', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'food services\r\nfood and groceries\r\nfood and beverage', '', 'S', 4, 'food-establishment-top4', 'http://schema.org/FoodEstablishment'),
(23, 'government-office', 'GovernmentOffice', 'Government Office', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Goverment Offices\r\nGoverment departments\r\nGoverment Services', '', 'S', 4, '', 'http://schema.org/GovernmentOffice'),
(24, 'health-and-beauty', 'HealthAndBeautyBusiness', 'Health and Beauty', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 4, 'health-and-beauty-top4', 'http://schema.org/HealthAndBeautyBusiness'),
(25, 'home-construction-businesses', 'HomeAndConstructionBusiness', 'Home and Construction Businesses', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Home Construction\r\nHome Designs\r\nHouse Plans', '', 'S', 4, 'home-and-construction-businesses-top4', 'http://schema.org/HomeAndConstructionBusiness'),
(26, 'internet-cafe', 'InternetCafe', 'Internet Cafe', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '24 hour internet cafe\r\nInternet Cafes\r\nInternet', '', 'S', 4, 'internet-cafe-top4', 'http://schema.org/InternetCafe'),
(27, 'libraries', 'Library', 'Libraries', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Libraries\r\nLibrary Services\r\nLibrary Jobs', '', 'S', 4, '', 'http://schema.org/Library'),
(28, 'lodging-business', 'LodgingBusiness', 'Lodging Business', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Lodging\r\nLodges in Australia\r\nHostelry', '', 'S', 4, 'lodging-business-top4', 'http://schema.org/LodgingBusiness'),
(29, 'medical-organisations', 'MedicalOrganization', 'Medical Organisations', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Medical Association\r\nPublic Health Care\r\nMedical Services', '', 'S', 4, 'medical-organisations-top4', 'http://schema.org/MedicalOrganization'),
(30, 'professional-services', 'ProfessionalService', 'Professional Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Professional Support', '', 'S', 4, 'professional-services-top4', 'http://schema.org/EntertainmentBusiness/LocalClubs'),
(31, 'radio-stations', 'RadioStation', 'Radio Stations', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Radio Station\r\nAustralian Radio Station\r\nRadio Station Guide', '', 'S', 4, '', 'http://schema.org/RadioStation'),
(32, 'real-estate-agents', 'RealEstateAgent', 'Real Estate Agents', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Buyers agents\r\nProperty agents\r\nRental agents\r\nSettlement agents', '', 'A', 4, 'real-estate-agents-top4', 'http://schema.org/RealEstateAgent'),
(33, 'recycling-services', 'RecyclingCenter', 'Recycling Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'glass recycling\r\nplastic recycling\r\nrecycling companies australia', '', 'S', 4, 'recycling-services-top4', 'http://schema.org/RecyclingCenter'),
(34, 'self-storage', 'SelfStorage', 'Self Storage', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'self storage australia\r\nself storage sydney\r\nself storage association of australia', '', 'S', 4, '', 'http://schema.org/SelfStorage'),
(35, 'shopping-centres', 'ShoppingCenter', 'Shopping Centres', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'australia fair shopping centre\r\nonline shopping australia\r\nonline grocery shopping australia', '', 'S', 4, 'shopping-centres-top4', 'http://schema.org/ShoppingCenter'),
(36, 'sports-activity-location', 'SportsActivityLocation', 'Sports Activity Location', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'fitness for kids\r\nsport in schools australia\r\nsports activity centre', '', 'S', 4, '', 'http://schema.org/SportsActivityLocation'),
(37, 'store', 'Store', 'Store', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online clothing stores australia\r\nonline furniture stores australia\r\nbook stores australia', '', 'S', 4, 'store-top4', 'http://schema.org/Store'),
(38, 'television-station', 'TelevisionStation', 'Television Station', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'satellite tv\r\ntelevision stations in australia\r\ndigital tv reception', '', 'S', 4, '', 'http://schema.org/TelevisionStation'),
(39, 'tourism', 'TouristInformationCenter', 'Tourism', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Travel and tours', '', 'A', 4, 'tourism-top4', 'http://schema.org/LocalBusiness/Tourism'),
(40, 'travel-agents', 'TravelAgency', 'Travel Agents', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'travel agency sydney\r\ntravel agency australia\r\ntravel agents', '', 'S', 4, 'travel-agents-top4', 'http://schema.org/TravelAgency'),
(41, 'dancing-schools', 'DanceGroup', 'Dancing Schools', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'performing arts school sydney\r\nperforming arts course\r\ndance schools', '', 'S', 6, 'dancing-schools-top4', 'http://schema.org/DanceGroup'),
(42, 'music-schools', 'MusicGroup', 'Music Schools', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'australian music group\r\nuniversal music group\r\nmusic producer', '', 'S', 6, '', 'http://schema.org/MusicGroup'),
(43, 'theatre-groups', 'TheaterGroup', 'Theatre Groups', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'broadway shows\r\nbroadway musicals\r\nmusical theater', '', 'S', 6, '', 'http://schema.org/TheaterGroup'),
(44, 'vehicle-repairs', 'AutoBodyShop', 'Vehicle Repairs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto Body Shops\r\nAuto Body Repairs\r\nCar Body Shop', '', 'S', 15, '', 'http://schema.org/AutoBodyShop'),
(45, 'automotive-dealers-and-retails', 'AutoDealer', 'Automotive Dealers and Retails', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto Dealers\r\nCar Sales\r\nBuy Cars', '', 'S', 15, 'automotive-dealers-and-retails-top4', 'http://schema.org/AutoDealer'),
(46, 'automotive-services', 'AutoPartsStore', 'Automotive services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto repairs\r\nCar repairs\r\nMechanical repairs\r\nMechanics\r\nVehicle repairs \r\nAuto services\r\nCar services\r\nMechanical services\r\nVehicle services', '', 'A', 15, 'automotive-services-top4', 'http://schema.org/AutoPartsStore'),
(47, 'car-rentals', 'AutoRental', 'Car Rentals', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto Rentals\r\nCar Rentals\r\nCar Hire\r\nVehicle hire', '', 'A', 15, 'car-rentals-top4', 'http://schema.org/AutoRental'),
(48, 'auto-repairs', 'AutoRepair', 'Auto Repairs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto repairs\r\nAuto Fix\r\nAustralia Auto Repair', '', 'S', 15, 'auto-repairs-top4', 'http://schema.org/AutoRepair'),
(49, 'car-wash', 'AutoWash', 'Car Wash', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Auto Car Wash\r\nCar Wash\r\nCar Cleaning', '', 'S', 15, '', 'http://schema.org/AutoWash'),
(50, 'petrol-stations', 'GasStation', 'Petrol Stations', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Gas Stations\r\nNearest Gas Stations\r\nGas Service Station', '', 'S', 15, 'petrol-stations-top4', 'http://schema.org/GasStation'),
(51, 'motorcycle-dealer-and-retail', 'MotorcycleDealer', 'Motorcycle Dealer and Retail', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Motorcycle Dealers\r\nMotorcycle for sale\r\nAustralian Motorcycle Dealers', '', 'S', 15, '', 'http://schema.org/MotorcycleDealer'),
(52, 'motorcycle-repairs', 'MotorcycleRepair', 'Motorcycle Repairs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'motorcycle repairs\r\nFixing Motorcycle\r\nmotorcycle maintenance', '', 'S', 15, '', 'http://schema.org/MotorcycleRepair'),
(53, 'fire-stations', 'FireStation', 'Fire Stations', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Fire Stations\r\nAustralian Fire Stations\r\nFire Station Services', '', 'S', 18, '', 'http://schema.org/FireStation'),
(54, 'hospitals', 'Hospital', 'Hospitals', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Hospitals\r\npublic hospitals\r\nAustralian Hospital', '', 'S', 18, 'hospitals-top4', 'http://schema.org/Hospital'),
(55, 'police-stations', 'PoliceStation', 'Police Stations', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Police Stations\r\nAustralian Police Stations\r\nNearest Police Stations', '', 'S', 18, '', 'http://schema.org/PoliceStation'),
(56, 'adult-entertainment', 'AdultEntertainment', 'Adult Entertainment', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Adult Entertainments\r\nadult entertainers\r\nred light district', '', 'S', 20, '', 'http://schema.org/AdultEntertainment'),
(57, 'theme-parks', 'AmusementPark', 'Theme Parks', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Amusement Parks\r\nAustralian Amusement Parks\r\nFun Parks', '', 'S', 20, '', 'http://schema.org/AmusementPark'),
(58, 'art-galleries', 'ArtGallery', 'Art Galleries', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'art galleries\r\nAustralian Art Galleries\r\nModern Art Gallery', '', 'S', 20, '', 'http://schema.org/ArtGallery'),
(59, 'casinos', 'Casino', 'Casinos', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Casinos\r\nCasinos in Australia\r\nFind Casinos', '', 'S', 20, '', 'http://schema.org/Casino'),
(60, 'comedy-clubs', 'ComedyClub', 'Comedy Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Comedy Clubs\r\nAustralia Comedy Club\r\nComedy Centrals', '', 'S', 20, '', 'http://schema.org/ComedyClub'),
(61, 'movie-cinemas', 'MovieTheater', 'Movie Cinemas', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'movies theaters\r\nlatest movies in theaters\r\nMovie Cinemas', '', 'S', 20, '', 'http://schema.org/MovieTheater'),
(62, 'clubs', 'NightClub', 'Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Night Clubs\r\nNight Club in Australia\r\nLounges', '', 'S', 20, 'clubs-top4', 'http://schema.org/NightClub'),
(63, 'accounting-services', 'AccountingService', 'Accounting Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Accountants', '', 'A', 21, 'accounting-services-top4', 'http://schema.org/AccountingService'),
(64, 'atm', 'AutomatedTeller', 'ATM', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Automated Tellers\r\nAutomated Teller Locations\r\nNearest ATM', '', 'S', 21, 'atm-top4', 'http://schema.org/AutomatedTeller'),
(65, 'banking-and-financial-services', 'BankOrCreditUnion', 'Banking and Financial Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'financial services\r\nbanking', '', 'A', 21, 'banking-and-financial-services-top4', 'http://schema.org/BankOrCreditUnion'),
(66, 'insurance-agencies', 'InsuranceAgency', 'Insurance Agencies', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Insurance Agencies\r\ninsurance companies\r\n', '', 'A', 21, 'insurance-agencies-top4', 'http://schema.org/InsuranceAgency'),
(67, 'bakeries', 'Bakery', 'Bakeries', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Bakeries\r\nCake Bakeries\r\nBakery in Australia', '', 'S', 22, 'bakeries-top4', 'http://schema.org/Bakery'),
(68, 'bars-and-pubs', 'BarOrPub', 'Bars and Pubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Bars\r\nPubs\r\nNightclubs', '', 'A', 22, 'bars-and-pubs-top4', 'http://schema.org/BarOrPub'),
(69, 'brewery', 'Brewery', 'Brewery', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Breweries\r\nAustralian Brewery\r\nBrewery Australia', '', 'S', 22, '', 'http://schema.org/Brewery'),
(70, 'cafes', 'CafeOrCoffeeShop', 'Cafes', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'cafe\r\ncoffee Shop\r\nCoffeehouse', '', 'A', 22, 'cafes-top4', 'http://schema.org/CafeOrCoffeeShop'),
(71, 'fast-food-and-take-away-food', 'FastFoodRestaurant', 'Fast-food and Take Away Food', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Fast Food Restaurants\r\nFast Foods\r\nFast Food Restaurants in Australia', '', 'S', 22, '', 'http://schema.org/FastFoodRestaurant'),
(72, 'ice-creams-and-gelato', 'IceCreamShop', 'Ice Creams and Gelato', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Ice Cream Shops\r\nIce Cream Shops Australia\r\nIce Creams', '', 'S', 22, 'ice-creams-and-gelato-top4', 'http://schema.org/IceCreamShop'),
(73, 'restaurants', 'Restaurant', 'Restaurants ', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'dining \r\ncuisine\r\nbistro\r\ncarvery', '', 'A', 22, 'restaurants-top4', 'http://schema.org/Restaurant'),
(74, 'wineries', 'Winery', 'Wineries', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Wineries\r\nThe Wineries\r\nAustralian Wineries', '', 'S', 22, 'wineries-top4', 'http://schema.org/Winery'),
(75, 'post-offices', 'PostOffice', 'Post Offices', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Post Offices\r\nPost Offices Location\r\nAustralian Post Office', '', 'S', 23, '', 'http://schema.org/PostOffice'),
(76, 'beauty-salons', 'BeautySalon', 'Beauty Salons', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Beauty Salons\r\nBeauty Salons Australia\r\nhair and beauty salon', '', 'S', 24, '', 'http://schema.org/BeautySalon'),
(77, 'medi-spas', 'DaySpa', 'Medi Spas', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Day Spa Australia\r\nDay Spa Packages\r\nLuxury Day Spa', '', 'S', 24, '', 'http://schema.org/DaySpa'),
(78, 'hair-salons-and-barbers', 'HairSalon', 'Hair Salons and Barbers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Hair Salons\r\nHair Salons Australia\r\nBest Hair Salons', '', 'S', 24, 'hair-salons-and-barbers-top4', 'http://schema.org/HairSalon'),
(79, 'health-clubs', 'HealthClub', 'Health Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Health Clubs\r\nPure Health Clubs\r\nGood Health Club', '', 'S', 24, 'health-clubs-top4', 'http://schema.org/HealthClub'),
(80, 'nail-salons', 'NailSalon', 'Nail Salons', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Nail Salons\r\nNails Salon\r\nNail Arts', '', 'S', 24, '', 'http://schema.org/NailSalon'),
(81, 'tattooing', 'TattooParlor', 'Tattooing', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Tattoo Parlors\r\nTattoo Designs\r\nTattoo Shops', '', 'S', 24, '', 'http://schema.org/TattooParlor'),
(82, 'electrical-contractors', 'Electrician', 'Electrical Contractors', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Electricians ', '', 'A', 25, 'electrical-contractors-top4', 'http://schema.org/Electrician'),
(83, 'building-services', 'GeneralContractor', 'Building Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'construction services\r\nbuilding', '', 'A', 25, 'building-services-top4', 'http://schema.org/GeneralContractor'),
(84, 'air-conditioning-heating-installation', 'HVACBusiness', 'Air Conditioning and heating installation ', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Aircon', '', 'A', 25, 'air-conditioning-installations-and-services-top4', 'http://schema.org/HVACBusiness'),
(85, 'painters-and-decorators', 'HousePainter', 'Painters and Decorators', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'painting and decorating\r\npainter\r\ndecorator', '', 'A', 25, 'painters-and-decorators-top4', 'http://schema.org/HousePainter'),
(86, 'locksmiths', 'Locksmith', 'Locksmiths', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 25, 'locksmiths-top4', 'http://schema.org/Locksmith'),
(87, 'removalists', 'MovingCompany', 'Removalists', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Removals', '', 'A', 25, 'removalists-top4', 'http://schema.org/MovingCompany'),
(88, 'plumbers', 'Plumber', 'Plumbers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'plumbing\r\nplumbing company ', '', 'A', 25, 'plumbers-top4', 'http://schema.org/Plumber'),
(89, 'roofing', 'RoofingContractor', 'Roofing', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Roofers\r\nRoofs', '', 'A', 25, 'roofing-top4', 'http://schema.org/RoofingContractor'),
(90, 'bed-and-breakfast', 'BedAndBreakfast', 'Bed And Breakfast', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'BnB\r\nB&B', '', 'A', 28, 'bed-and-breakfast-top4', 'http://schema.org/BedAndBreakfast'),
(91, 'hostels-and-backpackers', 'Hostel', 'Hostels and Backpackers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Hostels\r\nBackpackers\r\nyouth hostel', '', 'A', 28, 'hostels-and-backpackers-top4', 'http://schema.org/Hostel'),
(92, 'hotels', 'Hotel', 'Hotels', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'accommodation\r\n', '', 'A', 28, 'hotels-top4', 'http://schema.org/Hotel'),
(93, 'motels', 'Motel', 'Motels', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Motels\r\nMotels around Australia\r\nCheap Motels', '', 'S', 28, '', 'http://schema.org/Motel'),
(94, 'dental-services', 'Dentist', 'Dental Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'dentists\r\ndentistry', '', 'A', 29, 'dental-services-top4', 'http://schema.org/Dentist'),
(95, 'medical-imaging-and-pathology', 'DiagnosticLab', 'Medical Imaging and Pathology', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'lab technician jobs\r\nlab tests online\r\ndiagnostic lab australia', '', 'S', 29, 'medical-imaging-and-pathology-top4', 'http://schema.org/DiagnosticLab'),
(96, 'medical-services', 'MedicalClinic', 'Medical Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Doctor ', '', 'A', 29, 'medical-services-top4', 'http://schema.org/MedicalClinic'),
(97, 'opticians-and-optometrists', 'Optician', 'Opticians and Optometrists', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'optometry australia\r\naustralian opticians\r\noptical glasses', '', 'S', 29, '', 'http://schema.org/Optician'),
(98, 'pharmacies', 'Pharmacy', 'Pharmacies', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'discount pharmacy\r\npharmacy online\r\nchemist online australia', '', 'S', 29, 'pharmacies-top4', 'http://schema.org/Pharmacy'),
(99, 'medical-practitioners', 'Physician', 'Medical Practitioners', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'physician\r\naustralian family physician\r\noccupational physician', '', 'S', 29, 'medical-practitioners-top4', 'http://schema.org/Physician'),
(100, 'veterinary-and-pet-services', 'VeterinaryCare', 'Veterinary and Pet Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Vet and Pet services', '', 'A', 29, 'veterinary-and-pet-services-top4', 'http://schema.org/VeterinaryCare'),
(101, 'solicitors', 'Attorney', 'Solicitors', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'lawyers\r\nlegal services\r\nlaw firms\r\nBarrister', '', 'A', 30, 'solicitors-top4', 'http://schema.org/Attorney'),
(102, 'public-notary', 'Notary', 'Public Notary', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Solicitors\r\nLawyers\r\nLegal services\r\nLaw firms\r\nBarrister', '', 'S', 30, '', 'http://schema.org/Notary'),
(103, 'bowling-clubs', 'BowlingAlley', 'Bowling Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'ten pin bowling\r\nbowling alleys\r\nsydney central bowling', '', 'S', 36, '', 'http://schema.org/BowlingAlley'),
(104, 'health-and-fitness-centers', 'ExerciseGym', 'Health and Fitness Centers ', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'gym australia\r\nhome gym\r\nfitness equipment', '', 'S', 36, 'health-and-fitness-centers-top4', 'http://schema.org/ExerciseGym'),
(105, 'golf-clubs', 'GolfCourse', 'Golf Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'golf courses\r\nbest golf courses in australia\r\ngolf courses sydney', '', 'S', 36, '', 'http://schema.org/GolfCourse'),
(106, 'swimming-pools', 'PublicSwimmingPool', 'Swimming Pools', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'inground pools\r\nlocal swimming pools\r\npublic swimming pools melbourne', '', 'S', 36, '', 'http://schema.org/PublicSwimmingPool'),
(107, 'ski-centres', 'SkiResort', 'Ski Centres', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'ski resorts australia\r\nsnow resorts australia\r\nskiing in australia', '', 'S', 36, '', 'http://schema.org/SkiResort'),
(108, 'sports-clubs', 'SportsClub', 'Sports Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'sports club australia\r\naust sports\r\nfind local sports clubs', '', 'S', 36, '', 'http://schema.org/SportsClub'),
(109, 'stadiums-and-arenas', 'StadiumOrArena', 'Stadiums and Arenas', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'anz stadium sydney\r\nstadium and arena in australia\r\nstadium sponsorship australia', '', 'S', 36, '', 'http://schema.org/StadiumOrArena'),
(110, 'tennis-clubs', 'TennisComplex', 'Tennis Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'tennis australia tournaments\r\ntennis training centre\r\ntennis coaches australia', '', 'S', 36, '', 'http://schema.org/TennisComplex'),
(111, 'bicycles-and-accessories', 'BikeStore', 'Bicycles and Accessories', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'bike sales australia\r\nonline bike store\r\nbicycle store australia', '', 'S', 37, '', 'http://schema.org/BikeStore'),
(112, 'book-stores', 'BookStore', 'Book Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'book store australia\r\nsecond hand books australia\r\ncheap books australia', '', 'S', 37, '', 'http://schema.org/BookStore'),
(113, 'clothing-stores', 'ClothingStore', 'Clothing Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online clothing stores australia\r\ndresses online australia\r\nfashion store australia', '', 'S', 37, '', 'http://schema.org/ClothingStore'),
(114, 'computer-retailers-and-services', 'ComputerStore', 'Computer retailers and services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'computer parts australia\r\ncomputer online store\r\nbest online computer store australia', '', 'S', 37, 'computer-equipments-top4', 'http://schema.org/ComputerStore'),
(115, 'convenience-stores', 'ConvenienceStore', 'Convenience Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'convenience stores australia\r\nconvenience stores for sale\r\nfranchise australia', '', 'S', 37, '', 'http://schema.org/ConvenienceStore'),
(116, 'department-stores', 'DepartmentStore', 'Department Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online department store australia\r\ndiscount department stores australia\r\ndepartment stores australia', '', 'S', 37, '', 'http://schema.org/DepartmentStore'),
(117, 'electrical-equipment-stores', 'ElectronicsStore', 'Electrical Equipment Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Electrical Suppliers\r\nElectronic equipment', '', 'S', 37, 'electrical-equipment-stores-top4', 'http://schema.org/ElectronicsStore'),
(118, 'florists', 'Florist', 'Florists', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'flower delivery sydney\r\nonline florist australia\r\naustralian flower delivery', '', 'S', 37, 'florists-top4', 'http://schema.org/Florist'),
(119, 'furniture-stores', 'FurnitureStore', 'Furniture Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online furniture stores australia\r\nfurniture stores\r\ncheap furniture stores', '', 'S', 37, 'furniture-stores-top4', 'http://schema.org/FurnitureStore'),
(120, 'garden-equipments-and-supplies', 'GardenStore', 'Garden Equipments and Supplies', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'buy plants online\r\ngarden store sydney\r\ngarden equipment australia', '', 'S', 37, 'garden-equipments-and-supplies-top4', 'http://schema.org/GardenStore'),
(121, 'grocery-stores', 'GroceryStore', 'Grocery Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online grocery shopping australia\r\ncheap groceries\r\naustralian grocery stores', '', 'S', 37, '', 'http://schema.org/GroceryStore'),
(122, 'hardware-stores', 'HardwareStore', 'Hardware Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'hardware stores\r\nhome hardware catalogue\r\nhardware stores sydney', '', 'S', 37, 'hardware-stores-top4', 'http://schema.org/HardwareStore'),
(123, 'arts-crafts-and-hobbies', 'HobbyShop', 'Arts, Crafts and Hobbies', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'hobby stores australia\r\nonline hobby store\r\nhobby stores', '', 'S', 37, '', 'http://schema.org/HobbyShop'),
(124, 'homeware', 'HomeGoodsStore', 'Homeware', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Home decor\r\nHome accessories', '', 'S', 37, 'homeware', 'http://schema.org/HomeGoodsStore'),
(125, 'jewellers', 'JewelryStore', 'Jewellers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'jewellery stores\r\njewellery online\r\njewelry store australia', '', 'S', 37, 'jewellers-top4', 'http://schema.org/JewelryStore'),
(126, 'bottle-shops', 'LiquorStore', 'Bottle Shops', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'wine australia\r\nliquor stores\r\nwine sales australia', '', 'S', 37, '', 'http://schema.org/LiquorStore'),
(127, 'menswear-stores', 'MensClothingStore', 'Menswear Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'mens clothing online\r\nonline mens clothing stores australia\r\nmen clothing online', '', 'S', 37, '', 'http://schema.org/MensClothingStore'),
(128, 'mobile-phones-and-accessories', 'MobilePhoneStore', 'Mobile Phones and Accessories', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'mobile phones australia\r\ncheap mobile phones australia\r\nmobile phone shops', '', 'S', 37, '', 'http://schema.org/MobilePhoneStore'),
(129, 'movie-rentals', 'MovieRentalStore', 'Movie Rentals', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online movie rental\r\nvideo rental stores\r\nrent movies online', '', 'S', 37, '', 'http://schema.org/MovieRentalStore'),
(130, 'music-shops', 'MusicStore', 'Music Shops', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'music stores australia\r\nonline music store australia\r\nmusic instrument store', '', 'S', 37, '', 'http://schema.org/MusicStore'),
(131, 'office-equipments-and-supplies', 'OfficeEquipmentStore', 'Office Equipments and Supplies', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'office equipment\r\noffice furniture sydney\r\noffice desk', '', 'S', 37, '', 'http://schema.org/OfficeEquipmentStore'),
(132, 'outlet-stores', 'OutletStore', 'Outlet Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'homewares online\r\noutlet stores online australia\r\noutlet stores australia', '', 'S', 37, '', 'http://schema.org/OutletStore'),
(133, 'pawnbrokers', 'PawnShop', 'Pawnbrokers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'pawn shops sydney\r\ngold and silver pawn shop\r\npawn shops australia', '', 'S', 37, '', 'http://schema.org/PawnShop'),
(134, 'pet-shops', 'PetStore', 'Pet Shops', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'online pet store\r\npet barn\r\npet warehouse', '', 'S', 37, '', 'http://schema.org/PetStore'),
(135, 'shoe-shops', 'ShoeStore', 'Shoe Shops', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'shoe stores\r\nonline shoe store\r\nshoes online australia', '', 'S', 37, '', 'http://schema.org/ShoeStore'),
(136, 'sporting-goods-and-services', 'SportingGoodsStore', 'Sporting Goods and Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'sporting goods stores sydney\r\nonline sports store\r\nsports equipment', '', 'S', 37, 'sporting-goods-and-services-top4', 'http://schema.org/SportingGoodsStore'),
(137, 'tyres', 'TireShop', 'Tyres', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'mag wheels\r\nonline tires australia\r\ntires australia', '', 'S', 37, '', 'http://schema.org/TireShop'),
(138, 'toy-stores', 'ToyStore', 'Toy Stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'S', 37, '', 'http://schema.org/ToyStore'),
(139, 'wholesalers', 'WholesaleStore', 'Wholesalers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'wholesale products australia\r\nwholesale supplies australia\r\nwholesale clothing australia', '', 'S', 37, 'wholesalers-top4', 'http://schema.org/WholesaleStore'),
(140, 'manufacturers', 'Manufacturer', 'Manufacturers', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Manufacturing\r\nManufacturer ', '', 'A', 0, 'manufacturer-top4', 'http://schema.org/Organization/Manufacturer'),
(141, 'garage-door', 'GarageDoor', 'Garage Door', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Garage doors\r\nGarage door installers', '', 'A', 25, 'garage-doors-top4', 'http://schema.org/HomeAndConstructionBusiness/GarageDoorInstaller'),
(142, 'digital-marketing', 'DigitalMarketing', 'Digital Marketing', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Digital agencies\r\nDigital marketing agencies\r\nDigital advertising agencies\r\nWeb Design agencies', '', 'A', 30, 'digital-marketing-top4', 'http://schema.org/ProfessionalService/WebDesignDevelopment'),
(143, 'tiling', 'TileWholesalerRetailer', 'Tiling', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Tiles\r\nTilers', '', 'A', 25, 'tiling-top4', 'http://schema.org/HomeAndConstructionBusiness/Tiling'),
(144, 'cosmetic-surgeons', 'CosmeticSurgeons', 'Cosmetic Surgeons', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Plastic surgery\r\nCosmetic surgery\r\nplastic surgeons', '', 'A', 24, 'cosmetic-surgeons-top4', 'http://schema.org/HealthAndBeautyBusiness/CosmeticSurgeons'),
(145, 'home-decor', 'HomeDecor', 'Home Decor', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Home Decorations\r\nHomewares\r\nWine Racks\r\nWine Storage', '', 'S', 25, 'home-decor-top4', 'http://schema.org/HomeAndConstructionBusiness/HomeDecor'),
(146, 'security-doors-and-shutters', 'SecurityDoorsShutters', 'Security Doors and Shutters', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 25, 'security-doors-and-shutters-top4', 'http://schema.org/HomeAndConstructionBusiness/SecurityDoorsAndShutters'),
(149, 'cleaning-services', 'Cleaning Services', 'Cleaning Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Cleaners', '', 'A', 4, 'cleaning-services-top4', 'http://schema.org/ProfessionalService/CleaningServices'),
(150, 'pest-control', 'PestControl', 'Pest Control ', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Termite control', '', 'A', 30, 'pest-control-top4', 'http://schema.org/ProfessionalService/PestControl'),
(151, 'fencing-gates', 'FencingGates', 'Fencing and Gates', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 25, 'fencing-gates-top4', 'http://schema.org/HomeAndConstructionBusiness/FencingAndGates'),
(152, 'renovation-services', 'RenovationServices', 'Renovation Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'renovators\r\nrenovations\r\nRemodeling', '', 'A', 25, 'renovation-services-top4', 'http://schema.org/HomeAndConstructionBusiness/RenovationServices'),
(153, 'gardening', 'Gardening', 'Gardening', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', 'Gardeners\r\nLandscaping ', '', 'A', 30, 'gardening-top4', 'http://schema.org/ProfessionalService/Gardening'),
(154, 'carpenters', 'Carpenters', 'Carpenters', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 25, 'carpenters-top4', 'http://schema.org/HomeAndConstructionBusiness/Carpenters'),
(155, 'homeware-and-appliances', 'HomewareAndAppliances', 'Homeware and Appliances', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 37, 'homeware-and-appliances-top4', 'http://schema.org/Store/HomewareAndAppliances'),
(156, 'building-supplies-and-hardware', 'BuildingSuppliesAndHardware', 'Building Supplies and Hardware', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 37, 'building-supplies-and-hardware-top4', 'http://schema.org/Store/BuildingSuppliesAndHardware'),
(157, 'computers-and-electronics-stores', 'ComputersAndElectronicsStores', 'Computers and electronics stores', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 37, 'computers-and-electronics-stores-top4', 'http://schema.org/Store/ComputersAndElectronics'),
(158, 'waste-services', 'WasteServices', 'Waste Services', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 4, 'waste-services-top4', 'http://schema.org/LocalBusiness/WasteServices'),
(159, 'doors-and-windows', 'Doorswindows', 'Doors and windows', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 25, '', 'http://schema.org/Organization '),
(160, 'local-clubs', 'LocalClubs', 'Local Clubs', '', 0, '2016-05-10 06:21:49', '2016-05-10 06:21:49', '', '', 'A', 20, 'local-clubs-top4', 'https://schema.org/EntertainmentBusiness/LocalClubs');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
