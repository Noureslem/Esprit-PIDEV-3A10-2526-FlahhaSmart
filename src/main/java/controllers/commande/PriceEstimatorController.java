package controllers.commande;

import javafx.application.Platform;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.input.Dragboard;
import javafx.scene.input.TransferMode;
import javafx.scene.layout.VBox;
import javafx.stage.FileChooser;
import services.commande.ImagePriceEstimatorService;

import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.util.Arrays;
import java.util.List;

public class PriceEstimatorController {

    @FXML private VBox uploadArea;
    @FXML private Label uploadPrompt;
    @FXML private VBox previewContainer;
    @FXML private ImageView imagePreview;
    @FXML private Button submitBtn;
    @FXML private ProgressIndicator loadingSpinner;
    @FXML private VBox resultContainer;
    @FXML private Label estimatedPrice;
    @FXML private VBox errorContainer;
    @FXML private Label errorMessage;

    private File selectedImageFile;
    private final ImagePriceEstimatorService estimatorService = new ImagePriceEstimatorService();

    private static final List<String> ALLOWED_EXTENSIONS = Arrays.asList("jpg", "jpeg", "png", "webp", "gif");
    private static final long MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB

    @FXML
    public void initialize() {
        // Drag & drop
        uploadArea.setOnDragOver(event -> {
            if (event.getGestureSource() != uploadArea && event.getDragboard().hasFiles()) {
                event.acceptTransferModes(TransferMode.COPY);
            }
            event.consume();
        });

        uploadArea.setOnDragDropped(event -> {
            Dragboard db = event.getDragboard();
            boolean success = false;
            if (db.hasFiles() && !db.getFiles().isEmpty()) {
                File file = db.getFiles().get(0);
                if (validateFile(file)) {
                    handleFileSelection(file);
                    success = true;
                }
            }
            event.setDropCompleted(success);
            event.consume();
        });

        // Clic sur la zone -> ouvre le sélecteur
        uploadArea.setOnMouseClicked(event -> {
            if (!(event.getTarget() instanceof Button)) {
                chooseFile();
            }
        });

        // Clic sur le libellé "Parcourir"
        uploadPrompt.setOnMouseClicked(event -> chooseFile());
    }

    private void chooseFile() {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Choisir une image du produit");
        fileChooser.getExtensionFilters().add(
                new FileChooser.ExtensionFilter("Images", "*.jpg", "*.jpeg", "*.png", "*.webp", "*.gif")
        );
        File file = fileChooser.showOpenDialog(uploadArea.getScene().getWindow());
        if (file != null && validateFile(file)) {
            handleFileSelection(file);
        }
    }

    private boolean validateFile(File file) {
        String name = file.getName().toLowerCase();
        String ext = name.substring(name.lastIndexOf('.') + 1);
        if (!ALLOWED_EXTENSIONS.contains(ext)) {
            showError("Format de fichier non autorisé. Utilisez JPEG, PNG, WEBP ou GIF.");
            return false;
        }
        if (file.length() > MAX_FILE_SIZE) {
            showError("Le fichier est trop volumineux. Taille maximale: 5MB.");
            return false;
        }
        return true;
    }

    private void handleFileSelection(File file) {
        selectedImageFile = file;
        try {
            Image img = new Image(new FileInputStream(file));
            imagePreview.setImage(img);
            uploadPrompt.setVisible(false);
            previewContainer.setVisible(true);
            submitBtn.setDisable(false);
            hideResults();
        } catch (IOException e) {
            showError("Impossible de lire l'image.");
        }
    }

    @FXML
    private void handleChangeImage() {
        selectedImageFile = null;
        imagePreview.setImage(null);
        uploadPrompt.setVisible(true);
        previewContainer.setVisible(false);
        submitBtn.setDisable(true);
        hideResults();
    }

    @FXML
    private void handleSubmit() {
        if (selectedImageFile == null) return;

        submitBtn.setDisable(true);
        loadingSpinner.setVisible(true);
        hideResults();

        Task<String> task = new Task<>() {
            @Override
            protected String call() throws Exception {
                return estimatorService.estimatePrice(selectedImageFile.toPath());
            }
        };

        task.setOnSucceeded(e -> {
            loadingSpinner.setVisible(false);
            String price = task.getValue();
            if (price != null && !price.isEmpty()) {
                estimatedPrice.setText(price);
                resultContainer.setVisible(true);
            } else {
                showError("Impossible de contacter l'IA. Vérifiez que Ollama est lancé et que le modèle qwen3-vl:4b est installé.");
            }
            if (selectedImageFile != null) {
                submitBtn.setDisable(false);
            }
        });

        task.setOnFailed(e -> {
            loadingSpinner.setVisible(false);
            showError("Une erreur est survenue lors de la communication avec Ollama.");
            if (selectedImageFile != null) {
                submitBtn.setDisable(false);
            }
        });

        new Thread(task).start();
    }

    private void showError(String message) {
        errorMessage.setText(message);
        errorContainer.setVisible(true);
        resultContainer.setVisible(false);
    }

    private void hideResults() {
        resultContainer.setVisible(false);
        errorContainer.setVisible(false);
    }

    // Méthode de reset pour le dashboard
    public void resetView() {
        handleChangeImage();
    }
}