package services.commande;

import entities.commande.Order;
import tools.myConnection;

import java.sql.*;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

public class OrderDAO {

    // ─── Validation ────────────────────────────────────────────────────────────

    private void validateOrder(Order order, boolean requireId) {
        List<String> errors = new ArrayList<>();

        if (order.getReference() == null || order.getReference().isBlank())
            errors.add("La référence est obligatoire.");
        else if (order.getReference().length() < 3 || order.getReference().length() > 50)
            errors.add("La référence doit contenir entre 3 et 50 caractères.");

        if (order.getDateCommande() == null)
            errors.add("La date de commande est obligatoire.");
        else if (order.getDateCommande().isAfter(LocalDate.now()))
            errors.add("La date de commande ne peut pas être dans le futur.");

        if (order.getStatut() == null || order.getStatut().isBlank())
            errors.add("Le statut est obligatoire.");

        if (order.getModePaiement() == null || order.getModePaiement().isBlank())
            errors.add("Le mode de paiement est obligatoire.");

        if (order.getAdresseLivraison() == null || order.getAdresseLivraison().isBlank())
            errors.add("L'adresse de livraison est obligatoire.");
        else if (order.getAdresseLivraison().length() < 10)
            errors.add("L'adresse de livraison doit contenir au moins 10 caractères.");

        if (order.getMontantTotal() <= 0)
            errors.add("Le montant total doit être un nombre positif.");

        if (order.getFraisLivraison() < 0)
            errors.add("Les frais de livraison ne peuvent pas être négatifs.");

        if (order.getIdUser() <= 0)
            errors.add("L'utilisateur associé est invalide.");

        if (requireId && order.getId() <= 0)
            errors.add("L'ID de la commande est invalide.");

        if (!errors.isEmpty())
            throw new IllegalArgumentException("Validation échouée :\n" + String.join("\n", errors));
    }

    // ─── INSERT ────────────────────────────────────────────────────────────────

    public void insertOrder(Order order) {
        validateOrder(order, false);

        String sql = "INSERT INTO commandes (reference, date_commande, statut, mode_paiement, " +
                "adresse_livraison, montant_total, frais_livraison, id_user) " +
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql)) {

            ps.setString(1, order.getReference().trim());
            ps.setDate(2, Date.valueOf(order.getDateCommande()));
            ps.setString(3, order.getStatut().trim());
            ps.setString(4, order.getModePaiement().trim());
            ps.setString(5, order.getAdresseLivraison().trim());
            ps.setDouble(6, order.getMontantTotal());
            ps.setDouble(7, order.getFraisLivraison());
            ps.setInt(8, order.getIdUser());

            int result = ps.executeUpdate();
            if (result > 0)
                System.out.println("[OrderDAO] ✅ Commande ajoutée avec succès.");

        } catch (IllegalArgumentException e) {
            System.out.println("[OrderDAO] ⚠ " + e.getMessage());
            throw e;
        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur insertion commande");
            e.printStackTrace();
        }
    }

    // ─── UPDATE ────────────────────────────────────────────────────────────────

    public void updateOrder(Order order) {
        validateOrder(order, true);

        String sql = "UPDATE commandes SET reference=?, date_commande=?, statut=?, mode_paiement=?, " +
                "adresse_livraison=?, montant_total=?, frais_livraison=?, id_user=? WHERE id_commande=?";

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql)) {

            ps.setString(1, order.getReference().trim());
            ps.setDate(2, Date.valueOf(order.getDateCommande()));
            ps.setString(3, order.getStatut().trim());
            ps.setString(4, order.getModePaiement().trim());
            ps.setString(5, order.getAdresseLivraison().trim());
            ps.setDouble(6, order.getMontantTotal());
            ps.setDouble(7, order.getFraisLivraison());
            ps.setInt(8, order.getIdUser());
            ps.setInt(9, order.getId());

            int rowsAffected = ps.executeUpdate();
            if (rowsAffected > 0)
                System.out.println("[OrderDAO] ✅ Commande mise à jour. ID: " + order.getId());
            else
                System.out.println("[OrderDAO] ⚠ Aucune commande trouvée avec ID: " + order.getId());

        } catch (IllegalArgumentException e) {
            System.out.println("[OrderDAO] ⚠ " + e.getMessage());
            throw e;
        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur mise à jour commande");
            e.printStackTrace();
        }
    }

    // ─── DELETE ────────────────────────────────────────────────────────────────

    public void deleteOrder(int id) {
        if (id <= 0) throw new IllegalArgumentException("ID commande invalide : " + id);

        String sql = "DELETE FROM commandes WHERE id_commande=?";

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql)) {

            ps.setInt(1, id);
            int rowsAffected = ps.executeUpdate();
            if (rowsAffected > 0)
                System.out.println("[OrderDAO] ✅ Commande supprimée. ID: " + id);
            else
                System.out.println("[OrderDAO] ⚠ Aucune commande trouvée avec ID: " + id);

        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur suppression commande");
            e.printStackTrace();
        }
    }

    // ─── GET ALL ───────────────────────────────────────────────────────────────

    public List<Order> getAllOrders() {
        String sql = "SELECT id_commande, reference, date_commande, statut, mode_paiement, " +
                "adresse_livraison, montant_total, frais_livraison, id_user " +
                "FROM commandes ORDER BY id_commande DESC";
        List<Order> orders = new ArrayList<>();

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {

            while (rs.next()) orders.add(mapRow(rs));
            System.out.println("[OrderDAO] ✅ " + orders.size() + " commandes récupérées.");

        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur récupération commandes");
            e.printStackTrace();
        }
        return orders;
    }

    // ─── SEARCH ────────────────────────────────────────────────────────────────

    public List<Order> searchOrdersByReference(String searchTerm) {
        String sql = "SELECT id_commande, reference, date_commande, statut, mode_paiement, " +
                "adresse_livraison, montant_total, frais_livraison, id_user " +
                "FROM commandes WHERE LOWER(reference) LIKE LOWER(?) ORDER BY id_commande DESC";
        List<Order> orders = new ArrayList<>();

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql)) {

            ps.setString(1, "%" + searchTerm + "%");
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) orders.add(mapRow(rs));
            }
            System.out.println("[OrderDAO] ✅ " + orders.size() + " commandes trouvées pour : " + searchTerm);

        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur recherche commandes");
            e.printStackTrace();
        }
        return orders;
    }

    // ─── GET BY ID ─────────────────────────────────────────────────────────────

    public Order getOrderById(int id) {
        String sql = "SELECT id_commande, reference, date_commande, statut, mode_paiement, " +
                "adresse_livraison, montant_total, frais_livraison, id_user " +
                "FROM commandes WHERE id_commande = ?";

        try (Connection conn = myConnection.getInstance().getCnx();
             PreparedStatement ps = conn.prepareStatement(sql)) {

            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    Order order = mapRow(rs);
                    System.out.println("[OrderDAO] ✅ Commande trouvée : " + order.getReference());
                    return order;
                }
            }
            System.out.println("[OrderDAO] ⚠ Aucune commande trouvée avec ID: " + id);

        } catch (SQLException e) {
            System.out.println("[OrderDAO] ❌ Erreur recherche commande par ID");
            e.printStackTrace();
        }
        return null;
    }

    // ─── Helper ────────────────────────────────────────────────────────────────

    private Order mapRow(ResultSet rs) throws SQLException {
        Date sqlDate = rs.getDate("date_commande");
        // Guard against NULL date in DB to avoid NullPointerException
        LocalDate dateCommande = (sqlDate != null) ? sqlDate.toLocalDate() : null;

        Order order = new Order(
                rs.getString("reference"),
                dateCommande,
                rs.getString("statut"),
                rs.getString("mode_paiement"),
                rs.getString("adresse_livraison"),
                rs.getDouble("montant_total"),
                rs.getDouble("frais_livraison"),
                rs.getInt("id_user")
        );
        order.setId(rs.getInt("id_commande"));
        return order;
    }
}