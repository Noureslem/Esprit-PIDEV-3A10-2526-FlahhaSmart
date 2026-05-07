package services.commande;

import entities.commande.Article;
import services.commande.ArticleDAO;

import java.time.LocalDate;
import java.time.YearMonth;
import java.util.ArrayList;
import java.util.List;

public class CalendarService {

    private final ArticleDAO articleDAO;

    public CalendarService() {
        this.articleDAO = new ArticleDAO();   // utilisation du DAO existant
    }

    /**
     * Récupère tous les événements (articles) pour un mois donné.
     */
    public List<CalendarEvent> getEventsForMonth(YearMonth yearMonth) {
        LocalDate firstDay = yearMonth.atDay(1);
        LocalDate lastDay = yearMonth.atEndOfMonth();

        List<Article> articles = articleDAO.findByDateAjoutBetween(firstDay, lastDay);
        List<CalendarEvent> events = new ArrayList<>();

        for (Article article : articles) {
            // dateAjout est un LocalDateTime, on prend le LocalDate
            LocalDate date = article.getDateAjout().toLocalDate();
            String title = "📦 " + article.getNom();
            String description = String.format(
                    "Prix: %.2f € | Stock: %d | Catégorie: %s",
                    article.getPrix(),
                    article.getStock(),
                    article.getCategorie() != null ? article.getCategorie() : "—"
            );
            events.add(new CalendarEvent(title, date, description, "#2e7d32", "white"));
        }
        return events;
    }

    // Classe interne représentant un événement du calendrier
    public static class CalendarEvent {
        private final String title;
        private final LocalDate date;
        private final String description;
        private final String color;
        private final String textColor;

        public CalendarEvent(String title, LocalDate date, String description, String color, String textColor) {
            this.title = title;
            this.date = date;
            this.description = description;
            this.color = color;
            this.textColor = textColor;
        }

        public String getTitle() { return title; }
        public LocalDate getDate() { return date; }
        public String getDescription() { return description; }
        public String getColor() { return color; }
        public String getTextColor() { return textColor; }
    }
}