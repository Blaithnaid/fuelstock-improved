-- G00405899 / Iarla Sparrow Burke
-- OLD SQL FILE: ONLY FOR REFERENCE

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `FUEL_PRICES` (
  `FUEL_PRICE_ID` smallint(2) NOT NULL,
  `FUEL_TYPE_CODE` smallint(2) DEFAULT NULL,
  `FUEL_PRICE_DATE` varchar(9) DEFAULT NULL,
  `UNIT_BUYING_PRICE` double DEFAULT NULL,
  `UNIT_SALES_PRICE` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `FUEL_PRICES` (`FUEL_PRICE_ID`, `FUEL_TYPE_CODE`, `FUEL_PRICE_DATE`, `UNIT_BUYING_PRICE`, `UNIT_SALES_PRICE`) VALUES
(1, 1, '15/11/23', 1.2, 1.4),
(2, 2, '15/11/23', 1.3, 1.5),
(3, 3, '15/11/23', 0.1, 0.2),
(4, 1, '16/11/23', 1.25, 1.45),
(5, 2, '16/11/23', 1.35, 1.55),
(6, 3, '16/11/23', 0.15, 0.25),
(7, 1, '17/11/23', 1.3, 1.5),
(8, 2, '17/11/23', 1.4, 1.6),
(9, 3, '17/11/23', 0.2, 0.3),
(10, 1, '18/11/23', 1.35, 1.55),
(11, 2, '18/11/23', 1.45, 1.65),
(12, 3, '18/11/23', 0.25, 0.35),
(13, 1, '19/11/23', 1.4, 1.6),
(14, 2, '19/11/23', 1.5, 1.7),
(15, 3, '19/11/23', 0.3, 0.4),
(16, 1, '20/11/23', 1.45, 1.65),
(17, 2, '20/11/23', 1.55, 1.75),
(18, 3, '20/11/23', 0.35, 0.45),
(19, 1, '21/11/23', 1.5, 1.7),
(20, 2, '21/11/23', 1.6, 1.8),
(21, 3, '21/11/23', 0.4, 0.5),
(22, 1, '22/11/23', 1.55, 1.75),
(23, 2, '22/11/23', 1.65, 1.85),
(24, 3, '22/11/23', 0.45, 0.55),
(25, 1, '23/11/23', 1.6, 1.8),
(26, 2, '23/11/23', 1.7, 1.9),
(27, 3, '23/11/23', 0.5, 0.6),
(28, 1, '24/11/23', 1.65, 1.85),
(29, 2, '24/11/23', 1.75, 1.95),
(30, 3, '24/11/23', 0.55, 0.65),
(31, 1, '25/11/23', 1.7, 1.9),
(32, 2, '25/11/23', 1.8, 2),
(33, 3, '25/11/23', 0.6, 0.7),
(34, 1, '26/11/23', 1.75, 1.95),
(35, 2, '26/11/23', 1.85, 2.05),
(36, 3, '26/11/23', 0.65, 0.75),
(37, 1, '27/11/23', 1.8, 2),
(38, 2, '27/11/23', 1.9, 2.1),
(39, 3, '27/11/23', 0.7, 0.8),
(40, 1, '28/11/23', 1.85, 2.05),
(41, 2, '28/11/23', 1.95, 2.15),
(42, 3, '28/11/23', 0.75, 0.85),
(43, 1, '29/11/23', 1.9, 2.1),
(44, 2, '29/11/23', 2, 2.2),
(45, 3, '29/11/23', 0.8, 0.9);

CREATE TABLE `FUEL_STOCK_LEVELS` (
  `STOCK_LEVEL_ID` int(11) NOT NULL,
  `STOCK_RECORDING_DATE` varchar(9) NOT NULL,
  `FUEL_TYPE_CODE` smallint(2) DEFAULT NULL,
  `QUANTITY_IN_STOCK` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `FUEL_STOCK_LEVELS` (`STOCK_LEVEL_ID`, `STOCK_RECORDING_DATE`, `FUEL_TYPE_CODE`, `QUANTITY_IN_STOCK`) VALUES
(1, '15/11/23', 1, 100),
(2, '15/11/23', 2, 150),
(3, '15/11/23', 3, 50),
(4, '16/11/23', 1, 120),
(5, '16/11/23', 2, 140),
(6, '16/11/23', 3, 60);

CREATE TABLE `REF_FUEL_TYPES` (
  `FUEL_TYPE_CODE` smallint(2) NOT NULL,
  `FUEL_TYPE_NAME` varchar(16) DEFAULT NULL,
  `FUEL_TYPE_DESCRIPTION` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `REF_FUEL_TYPES` (`FUEL_TYPE_CODE`, `FUEL_TYPE_NAME`, `FUEL_TYPE_DESCRIPTION`) VALUES
(1, 'Petrol', 'Standard unleaded gasoline'),
(2, 'Diesel', 'Diesel fuel for diesel engines'),
(3, 'Electricity', 'Electric power for electric vehicles');

CREATE TABLE `REF_TRANSACTION_TYPES` (
  `TRANSACTION_TYPE_CODE` int(11) NOT NULL,
  `TRANSACTION_TYPE_DESCRIPTION` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `REF_TRANSACTION_TYPES` (`TRANSACTION_TYPE_CODE`, `TRANSACTION_TYPE_DESCRIPTION`) VALUES
(1, 'Purchase'),
(2, 'Sale'),
(3, 'Refund');

CREATE TABLE `TRANSACTIONS` (
  `TRANSACTION_ID` smallint(2) NOT NULL,
  `FUEL_TYPE_CODE` smallint(2) DEFAULT NULL,
  `TRANSACTION_TYPE_CODE` int(11) DEFAULT NULL,
  `TRANSACTION_DATE` varchar(9) DEFAULT NULL,
  `TRANSACTION_AMOUNT` int(11) DEFAULT NULL,
  `OTHER_DETAILS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `TRANSACTIONS` (`TRANSACTION_ID`, `FUEL_TYPE_CODE`, `TRANSACTION_TYPE_CODE`, `TRANSACTION_DATE`, `TRANSACTION_AMOUNT`, `OTHER_DETAILS`) VALUES
(1, 1, 1, '15/11/23', 100, 'Filled up car with petrol'),
(2, 2, 2, '15/11/23', 150, 'Filled up truck with diesel'),
(3, 3, 1, '16/11/23', 120, 'Filled up car with LPG'),
(4, 1, 2, '16/11/23', 140, 'Filled up van with petrol'),
(5, 2, 1, '17/11/23', 60, 'Filled up car with diesel'),
(6, 1, 1, '18/11/23', 80, 'Filled up car with petrol'),
(7, 2, 2, '18/11/23', 160, 'Filled up truck with diesel'),
(8, 3, 1, '19/11/23', 130, 'Filled up car with LPG'),
(9, 1, 2, '19/11/23', 150, 'Filled up van with petrol'),
(10, 2, 1, '20/11/23', 70, 'Filled up car with diesel'),
(11, 1, 1, '21/11/23', 90, 'Filled up car with petrol'),
(12, 2, 2, '21/11/23', 170, 'Filled up truck with diesel'),
(13, 3, 1, '22/11/23', 140, 'Filled up car with LPG'),
(14, 1, 2, '22/11/23', 160, 'Filled up van with petrol'),
(15, 2, 1, '23/11/23', 80, 'Filled up car with diesel'),
(16, 1, 1, '24/11/23', 100, 'Filled up car with petrol'),
(17, 2, 2, '24/11/23', 180, 'Filled up truck with diesel'),
(18, 3, 1, '25/11/23', 150, 'Filled up car with LPG'),
(19, 1, 2, '25/11/23', 170, 'Filled up van with petrol'),
(20, 2, 1, '26/11/23', 90, 'Filled up car with diesel'),
(21, 1, 1, '27/11/23', 110, 'Filled up car with petrol'),
(22, 2, 2, '27/11/23', 190, 'Filled up truck with diesel'),
(23, 3, 1, '28/11/23', 160, 'Filled up car with LPG'),
(24, 1, 2, '28/11/23', 220, 'Filled up van with petrol & bought can of diesel'),
(27, 1, 2, '21/12/23', 2035, 'Petrol for car');

ALTER TABLE `FUEL_PRICES`
  ADD PRIMARY KEY (`FUEL_PRICE_ID`),
  ADD KEY `FUEL_TYPE_CODE` (`FUEL_TYPE_CODE`);

ALTER TABLE `FUEL_STOCK_LEVELS`
  ADD PRIMARY KEY (`STOCK_LEVEL_ID`),
  ADD KEY `FUEL_TYPE_CODE` (`FUEL_TYPE_CODE`);

ALTER TABLE `REF_FUEL_TYPES`
  ADD PRIMARY KEY (`FUEL_TYPE_CODE`);

ALTER TABLE `REF_TRANSACTION_TYPES`
  ADD PRIMARY KEY (`TRANSACTION_TYPE_CODE`);

ALTER TABLE `TRANSACTIONS`
  ADD PRIMARY KEY (`TRANSACTION_ID`),
  ADD KEY `FUEL_TYPE_CODE` (`FUEL_TYPE_CODE`),
  ADD KEY `TRANSACTION_TYPE_CODE` (`TRANSACTION_TYPE_CODE`);

ALTER TABLE `FUEL_PRICES`
  MODIFY `FUEL_PRICE_ID` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

ALTER TABLE `TRANSACTIONS`
  MODIFY `TRANSACTION_ID` smallint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `FUEL_PRICES`
  ADD CONSTRAINT `fuel_prices_ibfk_1` FOREIGN KEY (`FUEL_TYPE_CODE`) REFERENCES `REF_FUEL_TYPES` (`FUEL_TYPE_CODE`);

ALTER TABLE `FUEL_STOCK_LEVELS`
  ADD CONSTRAINT `fuel_stock_levels_ibfk_1` FOREIGN KEY (`FUEL_TYPE_CODE`) REFERENCES `REF_FUEL_TYPES` (`FUEL_TYPE_CODE`);

ALTER TABLE `TRANSACTIONS`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`FUEL_TYPE_CODE`) REFERENCES `REF_FUEL_TYPES` (`FUEL_TYPE_CODE`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`TRANSACTION_TYPE_CODE`) REFERENCES `REF_TRANSACTION_TYPES` (`TRANSACTION_TYPE_CODE`);
COMMIT;