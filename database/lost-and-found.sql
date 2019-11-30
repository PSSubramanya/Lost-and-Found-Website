CREATE TABLE `user` (
  `user_id` int PRIMARY KEY,
  `full_name` varchar(255),
  `mobile_number` int
);

CREATE TABLE `items` (
  `item_id` int AUTO_INCREMENT PRIMARY KEY,
  `description_about_item` varchar(255),
  `image_of_item` varchar(255),
  `place_of_found` varchar(255),
  `time_stamp` timestamp,
  `founder_id` int,
  `status` varchar(255)
);

CREATE TABLE `Lost_and_Found` (
  `id` int PRIMARY KEY,
  `loser_id` int,
  `founder_id` int,
  `item_id` int,
  `time_stamp` timestamp
);

ALTER TABLE `items` ADD FOREIGN KEY (`founder_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `Lost_and_Found` ADD FOREIGN KEY (`loser_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `Lost_and_Found` ADD FOREIGN KEY (`founder_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `Lost_and_Found` ADD FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);
