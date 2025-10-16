

INSERT INTO categorie (nom) VALUES ('Homme'), ('Femme'), ('Enfant');

INSERT INTO produit (nom, prix, image, categorie_id) VALUES
('T-shirt Homme Bleu', 19.99, 'tshirt_homme_bleu.jpg', 1),
('Jean Homme Slim', 49.99, 'jean_homme.jpg', 1),
('Casquette Homme', 14.99, 'casquette_homme.jpg', 1);

-- Produits pour Femme
INSERT INTO produit (nom, prix, image, categorie_id) VALUES
('Robe Rouge', 39.99, 'robe_rouge.jpg', 2),
('Sac à main', 59.99, 'sac_femme.jpg', 2),
('Chaussures Femme', 29.99, 'chaussures_femme.jpg', 2);

-- Produits pour Enfant
INSERT INTO produit (nom, prix, image, categorie_id) VALUES
('T-shirt Enfant', 12.99, 'tshirt_enfant.jpg', 3),
('Short Enfant', 15.99, 'short_enfant.jpg', 3),
('Chaussures Enfant', 19.99, 'chaussures_enfant.jpg', 3);