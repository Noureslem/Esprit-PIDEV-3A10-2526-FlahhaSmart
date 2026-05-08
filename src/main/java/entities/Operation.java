package entities;

import java.sql.Date;

public class Operation {
    private int id;
    private int equipement_id;
    private int id_user;
    private String nomEquipement;
    private String TypeOperation;
    private Date date_debut ;
    private Date date_fin ;
    private String statut;


    public Operation(int id_operation, int equipement_id, int id_user, String type_operation, Date date_debut, Date date_fin, String statut) {
        this.id = id_operation;
        this.equipement_id = equipement_id;
        this.id_user = id_user;
        this.TypeOperation = type_operation;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
        this.statut = statut;

    }
    public Operation(String type_operation, Date date_debut, Date date_fin, String statut) {
        this.equipement_id = equipement_id;
        this.TypeOperation = type_operation;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
        this.statut = statut;

    }

    public Operation(int id_user, String type_operation, Date date_debut, Date date_fin, String statut) {
        this.id_user = id_user;
        this.TypeOperation = type_operation;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
        this.statut = statut;
    }

    public Operation() {

    }

    public int getId_operation() {
        return id;
    }
    public void setId_operation(int id_operation) {
        this.id = id_operation;
    }
    public String getType_operation() {
        return TypeOperation;
    }
    public void setType_operation(String type_operation) {
        this.TypeOperation = type_operation;
    }
    public Date getDate_debut() {
        return date_debut;
    }
    public void setDate_operation(Date date_operation) {
        this.date_debut = date_operation;
    }
    public String getStatut() {
        return statut;
    }
    public void setStatut(String statut) {
        this.statut = statut;
    }
    public void setDate_debut(Date date_debut) {
        this.date_debut = date_debut;
    }
    public Date getDate_fin() {
        return date_fin;
    }
    public void setDate_fin(Date date_fin) {
        this.date_fin = date_fin;
    }
    public int getEquipement_id() {
        return equipement_id;
    }
    public void setEquipement_id(int equipement_id) {
        this.equipement_id = equipement_id;
    }
    public String getNomEquipement() {
        return nomEquipement;
    }
    public void setNomEquipement(String nomEquipement) {
        this.nomEquipement = nomEquipement;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    @Override
    public String toString() {
        return "Operation : " +
                " id_equipement = '" + equipement_id + '\'' +
                " id_user = '" + id_user + '\'' +
                " type_operation = '" + TypeOperation + '\'' +
                " Date Debut = " + date_debut +
                " Date Fin = " + date_fin +
                " statut = '" + statut + "'\n"
                ;
    }

}
