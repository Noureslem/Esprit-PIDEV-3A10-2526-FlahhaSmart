package services.commande;

import java.nio.file.Path;

public class ImagePriceEstimatorService {

    private int priceCallCount = 0;

    /**
     * Retourne un prix statique alternant à chaque appel.
     * 1er clic : 25.000 DT
     * 2e clic : 11.000.000.000 DT
     * 3e clic : 6000 DT
     * Puis cycle identique.
     */
    public String estimatePrice(Path imagePath) {
        priceCallCount++;
        switch (priceCallCount % 3) {
            case 1:  return "25.000 DT";
            case 2:  return "11.000.000.000 DT";
            case 0:  return "6000 DT";
            default: return "0 DT"; // jamais atteint
        }
    }
}