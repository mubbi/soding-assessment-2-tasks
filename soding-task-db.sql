--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `TaskID` int(11) UNSIGNED NOT NULL,
  `TaskName` varchar(250) NOT NULL,
  `TaskDescription` blob,
  `DateCreated` datetime NOT NULL,
  `DateUpdated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) UNSIGNED NOT NULL,
  `EmailID` varchar(150) NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `Salt` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `EmailID`, `FullName`, `Salt`, `Password`) VALUES
(1, 'mubbi@soding.com', 'Mubbasher Ahmed', '08B3jvKYx19RrOp8gsWLyJlHhocFZokz', '8a1f70b04bcd3da10bd9b62b5cc0648f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`TaskID`),
  ADD UNIQUE KEY `taskid_unique` (`TaskID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `userid_unique` (`UserID`),
  ADD UNIQUE KEY `email_unique` (`EmailID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `TaskID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;