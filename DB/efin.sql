-- Create `users` table
CREATE TABLE `user` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

-- Create `budget` table
CREATE TABLE `budget` (
    `budget_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `amount` DECIMAL(10, 2),
    `description` TEXT,
    `budget_date` DATE,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

-- Create `savings` table
CREATE TABLE `savings` (
    `savings_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `account_number` VARCHAR(50) NOT NULL,
    `balance` DECIMAL(10, 2),
    `opening_date` DATE,
    `interest_rate` DECIMAL(5, 2),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

-- Create `revenue` table
CREATE TABLE `revenue` (
    `revenue_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `amount` DECIMAL(10, 2),
    `description` TEXT,
    `revenue_date` DATE,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

-- Create `company_settings` table
CREATE TABLE `company_settings` (
    `setting_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `setting_name` VARCHAR(100) NOT NULL,
    `setting_value` TEXT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);



CREATE TABLE `assets` (
    `asset_id` INT AUTO_INCREMENT PRIMARY KEY,
    `asset_number` VARCHAR(50) NOT NULL,
    `purchased_date` DATE,
    `value` DECIMAL(10, 2),
    `description` TEXT,
    `asset_status` ENUM('active', 'inactive'),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_name` VARCHAR(100) NOT NULL,
    `purchase_date` DATE,
    `quantity` INT,
    `description` TEXT,
    `unit_price` DECIMAL(10, 2),
    `category` VARCHAR(100),
    `product_status` ENUM('active', 'inactive'),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `taxes` (
    `tax_id` INT AUTO_INCREMENT PRIMARY KEY,
    `tax_name` VARCHAR(100) NOT NULL,
    `tax_percentage` DECIMAL(5, 2) NOT NULL,
    `status` ENUM('pending', 'approved'),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `capital` (
    `capital_id` INT AUTO_INCREMENT PRIMARY KEY,
    `capital_name` VARCHAR(100) NOT NULL,
    `capital_date` DATE,
    `amount` DECIMAL(10, 2),
    `status` VARCHAR(50),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `customers` (
    `customer_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255),
    `address` TEXT,
    `phone` VARCHAR(20),
    `profile` TEXT,
    `status` VARCHAR(50),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `orders` (
    `order_id` INT AUTO_INCREMENT PRIMARY KEY,
    `product_name` VARCHAR(100) NOT NULL,
    `order_date` DATE,
    `quantity` INT,
    `shipping_address` TEXT,
    `payment_method` VARCHAR(100),
    `total_amount` DECIMAL(10, 2),
    `order_status` VARCHAR(50),
    `customer_name` VARCHAR(100),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `payments` (
    `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `invoice_number` VARCHAR(100),
    `amount` DECIMAL(10, 2),
    `payment_date` DATE,
    `customer_id` INT,
    `status` VARCHAR(50),
    `description` TEXT,
    `user_id` INT,
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `transactions` (
    `transaction_id` INT AUTO_INCREMENT PRIMARY KEY,
    `transaction_number` VARCHAR(100),
    `transaction_date` DATE,
    `transaction_type` VARCHAR(100),
    `amount` DECIMAL(10, 2),
    `description` TEXT,
    `customer_name` VARCHAR(100),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `invoice_settings` (
    `setting_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    `invoice_prefix` VARCHAR(50),
    `invoice_logo` VARCHAR(255),
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `invoices` (
    `invoice_id` INT AUTO_INCREMENT PRIMARY KEY,
    `invoice_number` VARCHAR(100),
    `invoice_date` DATE,
    `customer_name` VARCHAR(100),
    `total_amount` DECIMAL(10, 2),
    `due_date` DATE,
    `status` VARCHAR(50),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
);

CREATE TABLE `expenses` (
    `expense_id` INT AUTO_INCREMENT PRIMARY KEY,
    `expense_date` DATE NOT NULL,
    `purchased_by` VARCHAR(255) NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `description` TEXT,
    `status` VARCHAR(50),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

CREATE TABLE `suppliers` (
    `supplier_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100),
    `phone` VARCHAR(20),
    `address` VARCHAR(255),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);

CREATE TABLE `category` (
    `category_id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_name` VARCHAR(100) NOT NULL
);

CREATE TABLE `funds` (
    `fund_id` INT AUTO_INCREMENT PRIMARY KEY,
    `fund_name` VARCHAR(100) NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `description` TEXT,
    `status` VARCHAR(50),
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
);





-- INSERT INTO `users` table
INSERT INTO `user` (`user_id`, `username`, `email`, `password`)
VALUES (1, 'grayson', 'gray@gmail.com', '12345'),
       (2, 'glory', 'glory@gmail.com', '12345'),
       (3, 'lydi', 'lydi.com', '12345');


-- INSERT INTO `invoices` table
INSERT INTO `invoices` (`invoice_id`, `invoice_number`, `invoice_date`, `customer_name`, `total_amount`, `due_date`, `status`, `user_id`)
VALUES (1, 'INV-001', '2023-01-20', 'John Doe', 800.00, '2023-01-30', 'paid', 1),
       (2, 'INV-002', '2023-02-25', 'Alice Smith', 20000.00, '2023-03-07', 'pending', 2),
       (3, 'INV-003', '2023-03-15', 'Bob Johnson', 5000.00, '2023-03-25', 'pending', 3);

-- INSERT INTO `expenses` table (continued)
INSERT INTO `expenses` (`expense_id`, `expense_date`, `purchased_by`, `amount`, `description`, `status`, `user_id`)
VALUES (4, '2023-04-05', 'Jane Doe', 150.00, 'Office Supplies', 'Pending', 1),
       (5, '2023-04-10', 'Eva Smith', 200.00, 'Travel Expenses', 'Approved', 2),
       (6, '2023-04-20', 'David Johnson', 80.00, 'Advertising Costs', 'Approved', 3);

-- INSERT INTO `suppliers` table (continued)
INSERT INTO `suppliers` (`supplier_id`, `name`, `email`, `phone`, `address`, `user_id`)
VALUES (4, 'Supplier D', 'supplierD@example.com', '123-456-7890', '123 Main St, City', 1),
       (5, 'Supplier E', 'supplierE@example.com', '456-789-0123', '456 Elm St, Town', 2),
       (6, 'Supplier F', 'supplierF@example.com', '789-012-3456', '789 Oak St, Village', 3);

-- INSERT INTO `category` table (continued)
INSERT INTO `category` (`category_id`, `category_name`)
VALUES (4, 'Furniture'),
       (5, 'Stationery'),
       (6, 'Food');

-- INSERT INTO `funds` table (continued)
INSERT INTO `funds` (`fund_id`, `fund_name`, `amount`, `description`, `status`, `user_id`)
VALUES (4, 'Retirement Fund', 100000.00, 'Savings for retirement', 'Active', 1),
       (5, 'Emergency Fund', 5000.00, 'Savings for unexpected expenses', 'Active', 2),
       (6, 'Education Fund', 20000.00, 'Savings for children''s education', 'Active', 3);

-- INSERT INTO `budget` table
INSERT INTO `budget` (`budget_id`, `user_id`, `amount`, `description`, `budget_date`)
VALUES (1, 1, 5000.00, 'Monthly budget for groceries', '2023-04-01'),
       (2, 2, 3000.00, 'Monthly budget for utilities', '2023-04-01'),
       (3, 3, 7000.00, 'Monthly budget for rent', '2023-04-01');

-- INSERT INTO `savings` table
INSERT INTO `savings` (`savings_id`, `user_id`, `account_number`, `balance`, `opening_date`, `interest_rate`)
VALUES (1, 1, 'Savings123', 10000.00, '2023-01-01', 2.5),
       (2, 2, 'Savings456', 8000.00, '2023-01-01', 2.0),
       (3, 3, 'Savings789', 12000.00, '2023-01-01', 3.0);

-- INSERT INTO `revenue` table
INSERT INTO `revenue` (`revenue_id`, `user_id`, `amount`, `description`, `revenue_date`)
VALUES (1, 1, 5000.00, 'Sales revenue for January', '2023-01-31'),
       (2, 2, 7000.00, 'Sales revenue for January', '2023-01-31'),
       (3, 3, 10000.00, 'Sales revenue for January', '2023-01-31');

-- INSERT INTO `company_settings` table
INSERT INTO `company_settings` (`setting_id`, `user_id`, `setting_name`, `setting_value`)
VALUES (1, 1, 'Company Logo', 'logo.jpg'),
       (2, 2, 'Company Address', '123 Main St, City'),
       (3, 3, 'Company Phone', '123-456-7890');

-- INSERT INTO `assets` table
INSERT INTO `assets` (`asset_id`, `user_id`, `asset_number`, `purchased_date`, `value`, `description`, `asset_status`)
VALUES (1, 1, 'AS-001', '2023-01-15', 5000.00, 'Office Laptop', 'active'),
       (2, 2, 'AS-002', '2023-02-20', 7000.00, 'Delivery Van', 'active'),
       (3, 3, 'AS-003', '2023-03-10', 10000.00, 'Warehouse Equipment', 'inactive');

-- INSERT INTO `products` table
INSERT INTO `products` (`product_id`, `user_id`, `product_name`, `purchase_date`, `quantity`, `description`, `unit_price`, `category`, `product_status`)
VALUES (1, 1, 'Laptop', '2023-01-10', 10, 'Dell Inspiron', 800.00, 'Electronics', 'active'),
       (2, 2, 'Delivery Van', '2023-02-15', 2, 'Ford Transit', 20000.00, 'Vehicles', 'active'),
       (3, 3, 'Warehouse Shelving', '2023-03-05', 20, 'Heavy-duty steel shelves', 500.00, 'Storage', 'inactive');

-- INSERT INTO `taxes` table
INSERT INTO `taxes` (`tax_id`, `user_id`, `tax_name`, `tax_percentage`, `status`)
VALUES (1, 1, 'Sales Tax', 8.5, 'approved'),
       (2, 2, 'VAT', 20.0, 'pending'),
       (3, 3, 'Income Tax', 15.0, 'approved');

-- INSERT INTO `capital` table
INSERT INTO `capital` (`capital_id`, `user_id`, `capital_name`, `capital_date`, `amount`, `status`)
VALUES (1, 1, 'Initial Investment', '2023-01-01', 50000.00, 'active'),
       (2, 2, 'Seed Funding', '2023-02-15', 100000.00, 'active'),
       (3, 3, 'Venture Capital', '2023-03-20', 200000.00, 'active');

-- INSERT INTO `customers` table
INSERT INTO `customers` (`customer_id`, `user_id`, `name`, `email`, `address`, `phone`, `profile`, `status`)
VALUES (1, 1, 'John Doe', 'john@example.com', '123 Main St, City', '123-456-7890', 'Regular', 'active'),
       (2, 2, 'Alice Smith', 'alice@example.com', '456 Elm St, Town', '456-789-0123', 'VIP', 'active'),
       (3, 3, 'Bob Johnson', 'bob@example.com', '789 Oak St, Village', '789-012-3456', 'Regular', 'inactive');

-- INSERT INTO `orders` table
INSERT INTO `orders` (`order_id`, `user_id`, `product_name`, `order_date`, `quantity`, `shipping_address`, `payment_method`, `total_amount`, `order_status`, `customer_name`)
VALUES (1, 1, 'Laptop', '2023-01-20', 1, '123 Main St, City', 'Credit Card', 800.00, 'pending', 'John Doe'),
       (2, 2, 'Delivery Van', '2023-02-25', 1, '456 Elm St, Town', 'Bank Transfer', 20000.00, 'approved', 'Alice Smith'),
       (3, 3, 'Warehouse Shelving', '2023-03-15', 10, '789 Oak St, Village', 'Cash on Delivery', 5000.00, 'pending', 'Bob Johnson');

-- INSERT INTO `payments` table
INSERT INTO `payments` (`payment_id`, `invoice_number`, `amount`, `payment_date`, `customer_id`, `status`, `description`, `user_id`)
VALUES (1, 'INV-001', 500.00, '2023-01-25', 1, 'approved', 'Payment for Laptop purchase', 1),
       (2, 'INV-002', 1000.00, '2023-02-28', 2, 'approved', 'Payment for Delivery Van purchase', 2),
       (3, 'INV-003', 2500.00, '2023-03-20', 3, 'pending', 'Partial payment for Warehouse Shelving purchase', 3);

-- INSERT INTO `transactions` table
INSERT INTO `transactions` (`transaction_id`, `transaction_number`, `transaction_date`, `transaction_type`, `amount`, `description`, `customer_name`, `user_id`)
VALUES (1, 'TRXN-001', '2023-01-30', 'Sales', 800.00, 'Sale of Laptop', 'John Doe', 1),
       (2, 'TRXN-002', '2023-02-28', 'Sales', 20000.00, 'Sale of Delivery Van', 'Alice Smith', 2),
       (3, 'TRXN-003', '2023-03-20', 'Sales', 5000.00, 'Sale of Warehouse Shelving', 'Bob Johnson', 3);

-- INSERT INTO `invoice_settings` table
INSERT INTO `invoice_settings` (`setting_id`, `user_id`, `invoice_prefix`, `invoice_logo`)
VALUES (1, 1, 'INV', 'company_logo.png'),
       (2, 2, 'INVOICE', 'company_logo.png'),
       (3, 3, 'REC', 'company_logo.png');

-- INSERT INTO `expenses` table
INSERT INTO `expenses` (`expense_id`, `expense_date`, `purchased_by`, `amount`, `description`, `status`, `user_id`)
VALUES (1, '2023-02-01', 'John Doe', 50.00, 'Office Supplies', 'Approved', 1),
       (2, '2023-02-15', 'Alice Smith', 75.00, 'Travel Expenses', 'Pending', 2),
       (3, '2023-03-01', 'Bob Johnson', 100.00, 'Advertising Costs', 'Approved', 3);

-- INSERT INTO `suppliers` table
INSERT INTO `suppliers` (`supplier_id`, `name`, `email`, `phone`, `address`, `user_id`)
VALUES (1, 'Supplier A', 'supplierA@example.com', '123-456-7890', '123 Main St, City', 1),
       (2, 'Supplier B', 'supplierB@example.com', '456-789-0123', '456 Elm St, Town', 2),
       (3, 'Supplier C', 'supplierC@example.com', '789-012-3456', '789 Oak St, Village', 3);

-- INSERT INTO `category` table
INSERT INTO `category` (`category_id`, `category_name`)
VALUES (1, 'Electronics'),
       (2, 'Vehicles'),
       (3, 'Storage');

-- INSERT INTO `funds` table
INSERT INTO `funds` (`fund_id`, `fund_name`, `amount`, `description`, `status`, `user_id`)
VALUES (1, 'Emergency Fund', 5000.00, 'Emergency savings for unexpected expenses', 'Active', 1),
       (2, 'Travel Fund', 2000.00, 'Savings for future travel plans', 'Active', 2),
       (3, 'Education Fund', 10000.00, 'Savings for children''s education', 'Active', 3);


