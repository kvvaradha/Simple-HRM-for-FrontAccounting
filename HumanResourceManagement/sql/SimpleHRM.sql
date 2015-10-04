-- --------------------------------------------------------

--
-- Table structure for table `0_kv_empl_info`
--

CREATE TABLE IF NOT EXISTS `0_kv_empl_info` (
`empl_id` int(10) NOT NULL,
  `empl_name` varchar(100) NOT NULL,
  `pre_address` varchar(100) NOT NULL,
  `per_address` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `mobile_phone` int(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `grade` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `gross_salary` int(10) NOT NULL,
  `basic` int(10) NOT NULL,
  `date_of_join` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_kv_empl_info`
--

INSERT INTO `0_kv_empl_info` (`empl_id`, `empl_name`, `pre_address`, `per_address`, `date_of_birth`, `age`, `mobile_phone`, `email`, `grade`, `department`, `designation`, `gross_salary`, `basic`, `date_of_join`) VALUES
(3, 'Varadha', 'Karur', 'Karur\n', '1984-02-14', 27, 1234567890, 'admin@kvcodes.com', 'Junior', 'HRM', 'Executive', 3600, 800, '2013-09-02'),
(4, 'Mizan', 'UK', 'Bangladesh', '1977-09-24', 44, 2147483647, 'mizan@faabra.com', 'B', 'Web development', 'Senior Developer', 18000, 500, '2006-09-06'),
(5, 'Tamil', '', '', '2015-10-04', 0, 2147483647, 'admin@kvcodes.com', '', '', '', 12500, 1050, '2015-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `0_kv_empl_payslip`
--

CREATE TABLE IF NOT EXISTS `0_kv_empl_payslip` (
`id` int(10) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `empl_id` int(10) NOT NULL,
  `basic` int(10) NOT NULL,
  `da` int(10) NOT NULL,
  `hra` int(10) NOT NULL,
  `convey_allow` int(10) NOT NULL,
  `edu_other_allow` int(10) NOT NULL,
  `pf` int(10) NOT NULL,
  `lop_amount` int(10) NOT NULL,
  `tds` int(10) NOT NULL,
  `total_ded` int(10) NOT NULL,
  `total_net` int(10) NOT NULL,
  `date_of_pay` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_kv_empl_payslip`
--

INSERT INTO `0_kv_empl_payslip` (`id`, `year`, `month`, `empl_id`, `basic`, `da`, `hra`, `convey_allow`, `edu_other_allow`, `pf`, `lop_amount`, `tds`, `total_ded`, `total_net`, `date_of_pay`) VALUES
(1, 1, 3, 4, 2850, 1900, 1900, 950, 1900, 570, 1140, 0, 1960, 7540, '2015-09-24'),
(2, 1, 2, 2, 600, 400, 400, 200, 400, 120, 240, 0, 510, 1490, '2015-09-24'),
(4, 1, 2, 4, 5400, 3600, 3600, 1800, 3600, 1080, 2160, 0, 5590, 12410, '2015-10-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_kv_empl_info`
--
ALTER TABLE `0_kv_empl_info`
 ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `0_kv_empl_payslip`
--
ALTER TABLE `0_kv_empl_payslip`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0_kv_empl_info`
--
ALTER TABLE `0_kv_empl_info`
MODIFY `empl_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `0_kv_empl_payslip`
--
ALTER TABLE `0_kv_empl_payslip`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
