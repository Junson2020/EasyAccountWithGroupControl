--
-- ��Ʈw�G `junson_user`
--

-- --------------------------------------------------------

--
-- ��ƪ��c `groupitem`
--

CREATE TABLE `groupitem` (
  `gname` varchar(30) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `power` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `groupitem`
--

INSERT INTO `groupitem` (`gname`, `descr`, `power`) VALUES
('admin', 'Administrator', '88888'),
('operator', 'Operator', '55555'),
('root', 'root', '99999'),
('SuperUser', 'SuperUser', '77777'),
('viewer', 'Viewer', '11111');

-- --------------------------------------------------------

--
-- ��ƪ��c `grouplevel`
--

CREATE TABLE `grouplevel` (
  `u_group` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `grouplevel`
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
-- ��ƪ��c `levelitem`
--

CREATE TABLE `levelitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- �ɦL��ƪ���� `levelitem`
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
-- ��ƪ��c `logdata`
--

CREATE TABLE `logdata` (
  `logid` bigint(20) NOT NULL,
  `logtext` text NOT NULL,
  `logtime` varchar(20) NOT NULL,
  `logfrom` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `randkey`
--

CREATE TABLE `randkey` (
  `randsn` varchar(128) NOT NULL,
  `keyitem` varchar(100) NOT NULL,
  `addtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `randpswd`
--

CREATE TABLE `randpswd` (
  `licensenumber` varchar(128) NOT NULL,
  `pswd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `userinfo`
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
-- �ɦL��ƪ���� `userinfo`
--

INSERT INTO `userinfo` (`u_account`, `u_pswd`, `u_name`, `u_cell`, `u_group`, `u_email`, `stopyn`, `u_fixtime`, `u_lastfix`, `u_language`) VALUES
('junson', 'junson2020', 'test', '000000', 'root', '', 'N', NULL, NULL, 'en');

-- --------------------------------------------------------

--
-- ��ƪ��c `userlevel`
--

CREATE TABLE `userlevel` (
  `u_account` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- ��ƪ��c `userlicenseall`
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
-- �w�ɦL��ƪ�����
--

--
-- ��ƪ���� `groupitem`
--
ALTER TABLE `groupitem`
  ADD PRIMARY KEY (`gname`);

--
-- ��ƪ���� `grouplevel`
--
ALTER TABLE `grouplevel`
  ADD PRIMARY KEY (`u_group`,`lname`);

--
-- ��ƪ���� `levelitem`
--
ALTER TABLE `levelitem`
  ADD PRIMARY KEY (`lname`);

--
-- ��ƪ���� `logdata`
--
ALTER TABLE `logdata`
  ADD PRIMARY KEY (`logid`);

--
-- ��ƪ���� `randkey`
--
ALTER TABLE `randkey`
  ADD PRIMARY KEY (`randsn`);

--
-- ��ƪ���� `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`u_account`);

--
-- ��ƪ���� `userlevel`
--
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`u_account`,`lname`);

--
-- ��ƪ���� `userlicenseall`
--
ALTER TABLE `userlicenseall`
  ADD PRIMARY KEY (`ulid`);

--
-- �b�ɦL����ƪ�ϥΦ۰ʻ��W(AUTO_INCREMENT)
--

--
-- �ϥθ�ƪ�۰ʻ��W(AUTO_INCREMENT) `logdata`
--
ALTER TABLE `logdata`
  MODIFY `logid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- �ϥθ�ƪ�۰ʻ��W(AUTO_INCREMENT) `userlicenseall`
--
ALTER TABLE `userlicenseall`
  MODIFY `ulid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;