INSERT INTO `recipe` (`recipeID`, `userID`, `RecipeName`, `Images`, `Servings`, `PreparationTime`, `Ratings`, `Ingredients`, `Instructions`, `DateAdded`, `TimeAdded`) VALUES
(1, NULL, 'Green smoothie', '', 2, 5, 4, '1 green apple, 2 kiwis, handful of fresh baby spinach, water', 'Mix everything in blender and enjoy!', '2020-11-04', '17:44:44'),
(2, NULL, 'Berry smoothie', '', 2, 5, 4, 'Berries, 1 banana, oat milk', 'Mix everything in blender and enjoy!', '2020-11-04', '17:47:39'),
(3, NULL, 'Caipirinha', '', 1, 4, 5, 'Pitu, ice cubes, brown sugar, lime', 'Smash lime and sugar in a glass. Add ice cubes and pitu. Enjoy!', '2020-11-04', '18:08:04'),
(4, NULL, 'Latte', '', 1, 10, 4, 'espresso coffee, milk', 'Make the espresso. Heat the milk. Put the hot milk in a cup and add the espresso.', '2020-11-04', '18:10:03');


INSERT INTO `user` (`userID`, `Username`, `Password`, `JoiningDate`) VALUES
(7, 'admin', '$2y$10$vvpgrsESGo21Mh8rF5vcN.WiHbJJ.blVJ5UjXDcQDzniIw1mBu/tq', '2020-11-04 00:00:00'),
(8, 'Laura', '$2y$10$s7RvsdKsDRc3F5E/JAYUx.NiOcjCpBIIZqypQUL1XBwbASyw2BTCS', '2020-11-04 00:00:00');
