USE restaurant;

CREATE TABLE users (
   user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
   name varchar(256) not null,
   phone varchar(256) not null,
   email varchar(256) not null,
   pswd varchar(256) not null
);

CREATE TABLE reservations (
   reservation_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
   name varchar(256) not null,
   date varchar(256) not null,
   time varchar(256) not null,
   guests varchar(256) not null,
   user_id varchar(256) not null
);

CREATE TABLE menu (
   item_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
   name varchar(256) not null,
   price varchar(256) not null,
   image varchar(256) not null
);

INSERT INTO menu (name, price, image) VALUES ('Hamburger', '$9.99', 'https://thumbs.dreamstime.com/b/vector-hamburger-clip-art-illustration-isolated-white-background-120332743.jpg%27');

INSERT INTO menu (name, price, image) VALUES ('Tacos', '$7.99', 'https://us.123rf.com/450wm/larryrains/larryrains1606/larryrains160601364/57935327-taco.jpg?ver=6%27');

INSERT INTO menu (name, price, image) VALUES ('Chicken Nuggets', '$6.99', 'https://st.depositphotos.com/1804893/3385/i/950/depositphotos_33852001-stock-photo-fried-nuggets.jpg');

INSERT INTO menu (name, price, image) VALUES ('Fries', '$2.99', 'https://previews.123rf.com/images/sudowoodo/sudowoodo1809/sudowoodo180900031/110122498-french-fries-on-plate-with-fry-dipped-in-ketchup-potato-side-or-appetizer-for-dinner-isolated-vector.jpg');

INSERT INTO menu (name, price, image) VALUES ('Pepperoni Pizza', '$9.99', 'https://previews.123rf.com/images/dmstudio/dmstudio1409/dmstudio140900015/31811120-vector-illustration-of-italian-pizza-with-pepperoni-slices.jpg');

INSERT INTO menu (name, price, image) VALUES ('Cheese Pizza', '$8.99', 'https://images.assetsdelivery.com/compings_v2/betka82/betka822108/betka82210800095.jpg');

INSERT INTO menu (name, price, image) VALUES ('Tater Tots', '$2.99', 'https://st2.depositphotos.com/3046849/6234/i/600/depositphotos_62345949-stock-photo-a-fast-food-container-of.jpg');