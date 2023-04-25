
CREATE TABLE `groupitem` (
  `gname` varchar(30) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `power` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `groupitem` (`gname`, `descr`, `power`) VALUES
('admin', 'Administrator', '88888'),
('operator', 'Operator', '55555'),
('root', 'root', '99999'),
('viewer', 'Viewer', '11111');

CREATE TABLE `grouplevel` (
  `u_group` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `grouplevel` (`u_group`, `lname`, `stopyn`) VALUES
('admin', 'UserEdit', 'N'),
('admin', 'UserList', 'N'),
('root', 'GroupList', 'N'),
('root', 'GroupSave', 'N'),
('root', 'LevelList', 'N'),
('root', 'LevelSave', 'N'),
('root', 'UserEdit', 'N'),
('root', 'UserList', 'N');

CREATE TABLE `levelitem` (
  `lname` varchar(20) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `levelitem` (`lname`, `descr`, `stopyn`) VALUES
('GroupList', 'GroupList', 'N'),
('GroupSave', 'GroupSave', 'N'),
('LevelList', 'LevelList', 'N'),
('LevelSave', 'LevelSave', 'N'),
('UserEdit', 'UserEdit', 'N'),
('UserList', 'UserList', 'N');

CREATE TABLE `randkey` (
  `randsn` varchar(128) NOT NULL,
  `keyitem` varchar(100) NOT NULL,
  `addtime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `userlevel` (
  `u_account` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `stopyn` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `groupitem`
  ADD PRIMARY KEY (`gname`);

ALTER TABLE `grouplevel`
  ADD PRIMARY KEY (`u_group`,`lname`);

ALTER TABLE `levelitem`
  ADD PRIMARY KEY (`lname`);
  
ALTER TABLE `userlevel`
  ADD PRIMARY KEY (`u_account`,`lname`);

ALTER TABLE `randkey`
  ADD PRIMARY KEY (`randsn`); 