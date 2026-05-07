package controllers.commande;

import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.Tooltip;
import javafx.scene.layout.*;
import javafx.scene.text.Font;
import javafx.scene.paint.Color;
import javafx.scene.shape.Rectangle;
import services.commande.CalendarService;
import services.commande.CalendarService.CalendarEvent;

import java.time.LocalDate;
import java.time.YearMonth;
import java.time.format.DateTimeFormatter;
import java.time.format.TextStyle;
import java.util.List;
import java.util.Locale;

public class CalendarController {

    @FXML private Label monthYearLabel;
    @FXML private GridPane calendarGrid;

    private YearMonth currentMonth;
    private final CalendarService calendarService;
    private final DateTimeFormatter monthFormatter = DateTimeFormatter.ofPattern("MMMM yyyy", Locale.FRENCH);

    private static final String[] DAY_NAMES = {"Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"};

    public CalendarController() {
        this.calendarService = new CalendarService();
        this.currentMonth = YearMonth.now();
    }

    @FXML
    public void initialize() {
        buildCalendar();
    }

    @FXML
    private void previousMonth() {
        currentMonth = currentMonth.minusMonths(1);
        buildCalendar();
    }

    @FXML
    private void nextMonth() {
        currentMonth = currentMonth.plusMonths(1);
        buildCalendar();
    }

    private void buildCalendar() {
        // Mise à jour du titre
        monthYearLabel.setText(currentMonth.format(monthFormatter));

        calendarGrid.getChildren().clear();
        calendarGrid.getColumnConstraints().clear();
        calendarGrid.getRowConstraints().clear();

        // 7 colonnes de largeur égale
        for (int i = 0; i < 7; i++) {
            ColumnConstraints col = new ColumnConstraints();
            col.setPercentWidth(100.0 / 7);
            calendarGrid.getColumnConstraints().add(col);
        }

        // Ligne d'en-tête des jours (0)
        for (int col = 0; col < 7; col++) {
            Label dayName = new Label(DAY_NAMES[col]);
            dayName.setFont(Font.font("System", 14));
            dayName.setAlignment(Pos.CENTER);
            dayName.setMaxWidth(Double.MAX_VALUE);
            dayName.setStyle("-fx-font-weight: bold; -fx-padding: 5;");
            calendarGrid.add(dayName, col, 0);
        }

        // Récupération des événements du mois
        List<CalendarEvent> events = calendarService.getEventsForMonth(currentMonth);

        // Premier jour du mois
        LocalDate firstDay = currentMonth.atDay(1);
        int startDayOfWeek = firstDay.getDayOfWeek().getValue(); // Lundi = 1
        int daysInMonth = currentMonth.lengthOfMonth();
        int totalDays = startDayOfWeek - 1 + daysInMonth;
        int rows = (int) Math.ceil(totalDays / 7.0) + 1; // +1 pour la ligne d'en-tête

        // Création des cellules
        int dayCounter = 1;
        int row = 1;

        for (int i = 0; i < totalDays; i++) {
            if (i < startDayOfWeek - 1) {
                // Jour du mois précédent (vide)
                addEmptyCell(row, (i % 7));
            } else {
                LocalDate date = firstDay.withDayOfMonth(dayCounter);
                VBox dayCell = createDayCell(date, events);
                calendarGrid.add(dayCell, i % 7, row);
                dayCounter++;
            }
            if ((i + 1) % 7 == 0) row++;
        }

        // Compléter la dernière ligne si nécessaire
// Compléter la dernière ligne si nécessaire
        while ((row - 1) * 7 <= totalDays) {
            int currentRow = row;             // ➕ capture dans une variable finale
            for (int col = 0; col < 7; col++) {
                final int currentCol = col;   // ➕ capture de col aussi (bonne pratique)
                boolean isEmpty = calendarGrid.getChildren().stream().noneMatch(node ->
                        GridPane.getColumnIndex(node) != null && GridPane.getColumnIndex(node) == currentCol &&
                                GridPane.getRowIndex(node) != null && GridPane.getRowIndex(node) == currentRow
                );
                if (isEmpty) {
                    addEmptyCell(currentRow, currentCol);
                }
            }
            row++;
        }
    }

    private void addEmptyCell(int row, int col) {
        VBox cell = new VBox();
        cell.setStyle("-fx-border-color: #e0e0e0; -fx-border-width: 0.5; -fx-background-color: #f5f5f5;");
        cell.setPrefHeight(100);
        calendarGrid.add(cell, col, row);
    }

    private VBox createDayCell(LocalDate date, List<CalendarEvent> events) {
        VBox cell = new VBox(2);
        cell.setStyle("-fx-border-color: #e0e0e0; -fx-border-width: 0.5; -fx-padding: 5;");
        cell.setPrefHeight(100);
        cell.setMaxHeight(Double.MAX_VALUE);

        // Numéro du jour
        Label dayNumber = new Label(String.valueOf(date.getDayOfMonth()));
        dayNumber.setFont(Font.font("System", 12));
        dayNumber.setAlignment(Pos.TOP_RIGHT);
        dayNumber.setMaxWidth(Double.MAX_VALUE);

        // Aujourd'hui en vert
        if (date.equals(LocalDate.now())) {
            cell.setStyle(cell.getStyle() + "-fx-background-color: #e8f5e9;");
            dayNumber.setStyle("-fx-font-weight: bold; -fx-text-fill: #2e7d32;");
        }

        cell.getChildren().add(dayNumber);

        // Ajouter les événements de ce jour
        for (CalendarEvent event : events) {
            if (event.getDate().equals(date)) {
                Label eventLabel = new Label(event.getTitle());
                eventLabel.setStyle("-fx-background-color: " + event.getColor() + "; -fx-text-fill: " + event.getTextColor() +
                        "; -fx-font-size: 10px; -fx-padding: 2 4; -fx-background-radius: 3; -fx-wrap-text: true;");
                eventLabel.setMaxWidth(Double.MAX_VALUE);
                Tooltip.install(eventLabel, new Tooltip(event.getDescription()));
                cell.getChildren().add(eventLabel);
            }
        }

        return cell;
    }
}