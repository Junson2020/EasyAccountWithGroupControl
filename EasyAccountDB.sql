--
-- 資料庫： `junson_user`
--

-- --------------------------------------------------------

--
-- 資料表結構 `groupitem`
--

CREATE TABLE `groupitem` (
  `gname` varchar(30) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `power` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `groupitem`
--

INSERT INTO `groupitem` (`gname`, `descr`, `power`) VALUES
('admin', 'Administrator', '88888'),
('operator', 'Operator', '55555'),
('root', 'root', '99999'),
('SuperUser', 'SuperUser', '77777'),
('viewer', 'Viewer', '11111');

-- --------------------------------------------------------

--
-- 資料表結構 `grouplevel`
--

CREATE TABLE `grouplevel` (
  `u_group` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `grouplevel`
--

INSERT INTO `grouplevel` (`u_group`, `lname`) VALUES
('admin', 'GroupLevel'),
('admin', 'GroupList'),
('admin', 'GroupSave'),
('admin', 'LevelList'),
('admin', 'LevelSave'),
('admin', 'UserDEL'),
('admin', 'UserEdit'),
('admin', 'UserLevel'),
('admin', 'UserList'),
('root', 'ENcode'),
('root', 'GroupLevel'),
('root', 'GroupList'),
('root', 'GroupSave'),
('root', 'LevelList'),
('root', 'LevelSave'),
('root', 'UserDEL'),
('root', 'UserEdit'),
('root', 'UserLevel'),
('root', 'UserList');

-- --------------------------------------------------------

--
-- 資料表結構 `levelitem`
--

CREATE TABLE `levelitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `levelitem`
--

INSERT INTO `levelitem` (`lname`, `descr`, `stopyn`) VALUES
('GroupList', 'GroupList', 'N'),
('GroupSave', 'GroupSave', 'N'),
('LevelList', 'LevelList', 'N'),
('LevelSave', 'LevelSave', 'N'),
('UserDEL', 'Delete User', 'N'),
('UserEdit', 'UserEdit', 'N'),
('UserLevel', 'UserLevel', 'N'),
('UserList', 'UserList', 'N');

-- --------------------------------------------------------

--
-- 資料表結構 `logdata`
--

CREATE TABLE `logdata` (
  `logid` bigint(20) NOT NULL,
  `logtext` text NOT NULL,
  `logtime` varchar(20) NOT NULL,
  `logfrom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `randkey`
--

CREATE TABLE `randkey` (
  `randsn` varchar(128) NOT NULL,
  `keyitem` varchar(100) NOT NULL,
  `addtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `randpswd`
--

CREATE TABLE `randpswd` (
  `licensenumber` varchar(128) NOT NULL,
  `pswd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `userinfo`
--

CREATE TABLE `userinfo` (
  `u_account` varchar(30) NOT NULL,
  `u_pswd` varchar(30) DEFAULT NULL,
  `u_name` varchar(100) DEFAULT NULL,
  `u_cell` varchar(30) DEFAULT NULL,
  `u_group` varchar(30) DEFAULT NULL,
  `u_email` varchar(50) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL,
  `u_fixtime` varchar(30) DEFAULT NULL,
  `u_lastfix` varchar(30) DEFAULT NULL,
  `u_language` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `userinfo`
--

INSERT INTO `userinfo` (`u_account`, `u_pswd`, `u_name`, `u_cell`, `u_group`, `u_email`, `stopyn`, `u_fixtime`, `u_lastfix`, `u_language`) VALUES
('junson', 'junson2020', 'test', '000000', 'root', '', 'N', NULL, NULL, 'en');

-- --------------------------------------------------------

--
-- 資料表結構 `userlevel`
--

CREATE TABLE `userlevel` (
  `u_account` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `userlicenseall`
--

CREATE TABLE `userlicenseall` (
  `ulid` bigint(20) NOT NULL,
  `u_account` varchar(30) DEFAULT NULL,
  `u_name` varchar(50) DEFAULT NULL,
  `licensenumber` varchar(100) DEFAULT NULL,
  `endtime` varchar(30) DEFAULT NULL,
  `u_group` varchar(255) DEFAULT NULL,
  `u_language` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `groupitem`
--
ALTER TABLE `groupitem`
  ADD PRIMARY KEY (`gname`);

--
-- 資料表索引 `grouplevel`
--
ALTER TABLE `grouplevel`
  ADD PRIMARY KEY (`u_group`,`lname`);

--
-- 資料表索引 `levelitem`
--
ALTER TABLE `levelitem`
  ADD PRIMARY KEY (`lname`);

--
-- 資料表索引 `logdata`
--
ALTER TABLE `logdata`
  ADD PRIMARY KEY (`logid`);

--
-- 資料表索引 `randkey`
--
ALTER TABLE `randkey`
  ADD PRIMARY KEY (`randsn`);

--
-- 資料表索引 `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`u_account`);

--
-- 資料表索引 `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`u_account`,`lname`);

--
-- 資料表索引 `userlicenseall`
--
ALTER TABLE `userlicenseall`
  ADD PRIMARY KEY (`ulid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `logdata`
--
ALTER TABLE `logdata`
  MODIFY `logid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `userlicenseall`
--
ALTER TABLE `userlicenseall`
  MODIFY `ulid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;