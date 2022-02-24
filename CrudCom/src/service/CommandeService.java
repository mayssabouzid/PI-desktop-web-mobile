/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package service;

import entities.Commande;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import utils.JDBC;

/**
 *
 * @author Mayssa
 */
public class CommandeService implements ICom<Commande> {

    Connection connexion;
    Statement stm;
    PreparedStatement ps;

    public CommandeService() {
        connexion = JDBC.getInstance().getConnexion();
    }

    @Override
    public void ajouter_Commande(Commande c) throws SQLException {
        String req = "INSERT INTO `commande` (`etat`, `prix`,`date`) VALUES ( '"
                + c.getEtat() + "', '" + c.getPrix() + "','" + c.getDate() + "') ";
        stm = connexion.createStatement();
        stm.executeUpdate(req);
    }

    @Override
    public List<Commande> afficher_Commande() throws SQLException {
        List<Commande> commande = new ArrayList<>();
        String req = "select * from commande";
        stm = connexion.createStatement();

        ResultSet rst = stm.executeQuery(req);

        while (rst.next()) {
            Commande c = new Commande(rst.getInt("idCom"),
                    rst.getString("etat"),
                    rst.getInt("prix"),
                    rst.getString("date"));
            commande.add(c);
        }
        return commande;
    }

    @Override
    public void modifier_Commande(Commande c) throws SQLException {
        String req = "update commande set etat = ? , prix = ? , date= ? where idCom = ?";

        try {
            ps = connexion.prepareStatement(req);
            ps.setString(1, c.getEtat());
            ps.setInt(2, c.getPrix());
            ps.setString(3, c.getDate());
            ps.setInt(4, c.getIdCom());

            ps.executeUpdate();

        } catch (SQLException ex) {
            Logger.getLogger(CommandeService.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @Override
    public void supprimer_Commande(Commande c) throws SQLException {
        String req = "delete from `commande` where `idCom`='" + c.getIdCom() + "'";
        stm = connexion.createStatement();
        stm.executeUpdate(req);
    }

}
