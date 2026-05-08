package controllers.Dashbord;

import javafx.scene.Node;
import javafx.scene.control.Alert;
import javafx.scene.layout.StackPane;
import javafx.scene.control.TabPane;
import controllers.Auth.Session;
import controllers.forum.ThreadController;
import entities.User;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.text.Text;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Locale;
import java.util.ResourceBundle;

public class DashboardAgriculteurController implements Initializable {

    @FXML private Label welcomeLabel;
    @FXML private Text welcomeText;
    @FXML private Text dateText;
    @FXML private Label dateLabel;
    @FXML private Label statusLabel;
    @FXML private StackPane contentArea;

    private User loggedInUser;

    // ===== MÉTHODES UTILITAIRES =====
    private void loadView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Node view = loader.load();
            contentArea.getChildren().setAll(view);
        } catch (IOException e) {
            e.printStackTrace();
            showAlert("Erreur", "Impossible de charger la vue : " + fxmlPath);
        }
    }

    private void loadMainViewAndSelectTab(int tabIndex) {
        String[] possiblePaths = {
                "/main-view.fxml",
                "/views/main-view.fxml",
                "/fxml/main-view.fxml",
                "/com/example/flahasmarty/main-view.fxml"
        };

        FXMLLoader loader = null;
        Node view = null;

        for (String path : possiblePaths) {
            try {
                loader = new FXMLLoader(getClass().getResource(path));
                if (loader.getLocation() != null) {
                    view = loader.load();
                    System.out.println("✅ main-view.fxml chargé depuis : " + path);
                    break;
                }
            } catch (IOException e) {
                // Ignorer
            }
        }

        if (view == null) {
            showAlert("Erreur", "main-view.fxml introuvable. Chemins testés : " + String.join(", ", possiblePaths));
            return;
        }

        TabPane tabPane = (TabPane) view;
        tabPane.getSelectionModel().select(tabIndex);
        contentArea.getChildren().setAll(view);
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }

    // ===== GESTION DES ARTICLES / COMMANDES =====
    @FXML
    private void handleGestionArticles(ActionEvent event) {
        loadMainViewAndSelectTab(0);
    }

    @FXML
    private void handleGestionCommandes(ActionEvent event) {
        loadMainViewAndSelectTab(1);
    }

    @FXML
    private void handleResultatsArticles(ActionEvent event) {
        loadMainViewAndSelectTab(2);
    }

    @FXML
    private void handleResultatsCommandes(ActionEvent event) {
        loadMainViewAndSelectTab(3);
    }

    @FXML
    private void handleTodoList(ActionEvent event) {
        loadMainViewAndSelectTab(4);
    }

    // ===== NOUVEAUX BOUTONS : CALENDRIER & ESTIMATION PRIX =====
    @FXML
    private void handleCalendar(ActionEvent event) {
        loadView("/views/calendar.fxml");
        setStatus("Calendrier");
    }

    @FXML
    private void handlePriceEstimator(ActionEvent event) {
        loadView("/views/price_estimator.fxml");
        setStatus("Estimation de prix par IA");
    }

    // ===== AUTRES HANDLERS =====
    @FXML
    public void handleForum(ActionEvent event) {
        try {
            try { api.ModerationAPI.demarrer(); } catch (Exception ignored) {}
            ThreadController forumController = new ThreadController();
            BorderPane forumView = forumController.buildView();
            contentArea.getChildren().clear();
            contentArea.getChildren().add(forumView);
            setStatus("Forum");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void setLoggedInUser(User user) {
        this.loggedInUser = user;
        if (user != null) {
            if (welcomeLabel != null) welcomeLabel.setText(user.getPrenom() + " " + user.getNom());
            if (welcomeText != null) welcomeText.setText("Bienvenue, " + user.getPrenom() + " !");
        }
    }

    @FXML
    public void handleStatistiques(ActionEvent e) {
        loadView("/views/advancedfeatures/Dashboard.fxml");
        setStatus("Statistiques");
    }

    @FXML
    public void handleParametres(ActionEvent e) {
        loadView("/views/agriculteur/Parametres.fxml");
        setStatus("Paramètres");
    }

    @FXML
    public void handleMeteo(ActionEvent e) {
        loadView("/views/advancedfeatures/WeatherView.fxml");
        setStatus("Météo");
    }

    @FXML
    public void handleAjouterOperation(ActionEvent e) {
        loadView("/views/operation/AjouterOp.fxml");
        setStatus("Ajouter opération");
    }

    @FXML
    public void handleListeOperations(ActionEvent e) {
        loadView("/views/operation/ListeOp.fxml");
        setStatus("Liste opérations");
    }

    @FXML
    public void handleAjouterEquipement(ActionEvent e) {
        loadView("/views/equipement/AjouterEq.fxml");
        setStatus("Ajouter équipement");
    }

    @FXML
    public void handleListeEquipements(ActionEvent e) {
        loadView("/views/equipement/ListeEq.fxml");
        setStatus("Liste équipements");
    }

    @FXML
    public void handleProduit(ActionEvent e) {
        loadView("/views/produit/BackStock.fxml");
        setStatus("Gestion Produit");
    }

    @FXML
    public void handleAgriBot(ActionEvent e) {
        loadView("/views/advancedfeatures/ChatbotView.fxml");
        setStatus("AgriBot");
    }

    @FXML
    public void handleAnalyseMaladie(ActionEvent e) {
        loadView("/views/advancedfeatures/PlantDiseaseView.fxml");
        setStatus("Analyse Maladie");
    }

    @FXML
    public void handleIrrigation(ActionEvent e) {
        loadView("/views/advancedfeatures/IrrigationView.fxml");
        setStatus("Irrigation");
    }

    @FXML
    public void handleRotationCultures(ActionEvent e) {
        loadView("/views/advancedfeatures/RotationCultureView.fxml");
        setStatus("Rotation Cultures");
    }

    @FXML
    public void handleProfil(ActionEvent event) {
        try {
            if (loggedInUser == null) return;
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/DashboardUser.fxml"));
            Parent profilView = loader.load();
            DashboardUser controller = loader.getController();
            if (controller != null) controller.setLoggedInUser(loggedInUser);
            contentArea.getChildren().clear();
            contentArea.getChildren().add(profilView);
            setStatus("Mon Profil");
        } catch (IOException e) { e.printStackTrace(); }
    }

    @FXML
    public void handleEditProfile(ActionEvent event) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/ProfileUser.fxml"));
            Parent editView = loader.load();
            ProfileUserController controller = loader.getController();
            if (controller != null && loggedInUser != null) controller.setUser(loggedInUser);
            contentArea.getChildren().clear();
            contentArea.getChildren().add(editView);
            setStatus("Modifier Profil");
        } catch (IOException e) { e.printStackTrace(); }
    }

    @FXML
    public void handleDeconnexion(ActionEvent event) {
        try {
            Session.logout();
            Parent root = FXMLLoader.load(getClass().getResource("/Login.fxml"));
            Stage stage = getStage();
            if (stage != null) {
                stage.setScene(new Scene(root));
                stage.setTitle("FlahaSmart - Connexion");
                stage.setMaximized(true);
                stage.show();
            }
        } catch (IOException e) { e.printStackTrace(); }
    }

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        System.out.println("✅ DashboardAgriculteurController initialisé");
        String today = LocalDate.now().format(DateTimeFormatter.ofPattern("EEEE dd MMMM yyyy", Locale.FRENCH));
        if (dateText != null) dateText.setText(today);
        if (dateLabel != null) dateLabel.setText(today);
        loadView("/views/advancedfeatures/Dashboard.fxml");
        setStatus("Dashboard");
    }

    private void setStatus(String msg) {
        if (statusLabel != null) statusLabel.setText(msg);
        System.out.println("📌 Section: " + msg);
    }

    private Stage getStage() {
        if (contentArea != null && contentArea.getScene() != null)
            return (Stage) contentArea.getScene().getWindow();
        return null;
    }
}