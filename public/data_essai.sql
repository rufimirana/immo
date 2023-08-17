select details_facture.quantite*details_facture.prix_unitaire as total_details from details_facture;
SELECT (details_facture.quantite*details_facture.prix_unitaire)+(details_facture.quantite*details_facture.prix_unitaire*details_facture.tva /100) as total_soumis_tva from details_facture;

select article,description,quantite,prix_unitaire,tva,details_facture.quantite*details_facture.prix_unitaire as total_details,
(details_facture.quantite*details_facture.prix_unitaire)+(details_facture.quantite*details_facture.prix_unitaire*details_facture.tva /100) as total_soumis_tva,
sum(total_details) as montant_sans_tva,
sum(total_soumis_tva) as montant_avec_tva
from details_facture;

create or replace view v_facture_details as select id,id_facture,article,
description,quantite,prix_unitaire,tva,details_facture.quantite*details_facture.prix_unitaire as total_details,
(details_facture.quantite*details_facture.prix_unitaire)+(details_facture.quantite*details_facture.prix_unitaire*details_facture.tva /100) as total_soumis_tva
from details_facture;
create or replace view v_total_montant as
select id,total_details,
total_soumis_tva,
sum(total_details) as montant_sans_tva,
sum(total_soumis_tva) as montant_avec_tva
from v_facture_details group by id;

create or replace view v_grand_total as
select id,id_facture,total_details,
total_soumis_tva,
sum(total_details) as montant_sans_tva,
sum(total_soumis_tva) as montant_avec_tva
from v_facture_details group by id_facture;

