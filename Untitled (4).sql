CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255),
  `password` varchar(255),
  `name` varchar(255),
  `created_at` datetime,
  `updated_at` datetime
);

CREATE TABLE `Events` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `daytime` datetime,
  `detail` varchar(255),
  `place` varchar(255),
  `latitude` double,
  `longitude` double,
  `user_id` int,
  `picture` varchar(255),
  `created_at` datetime,
  `updated_at` datetime
);

CREATE TABLE `Event_result` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_id` int,
  `report` text,
  `picture` varchar(255),
  `created_at` datetime,
  `updated_at` datetime
);

CREATE TABLE `Event_join` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `event_id` int,
  `created_at` datetime,
  `updated_at` datetime
);
