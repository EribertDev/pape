/**
 * Génère le code HTML pour un badge en fonction de l'état fourni.
 *
 * Cette fonction retourne un élément `<span>` avec une classe CSS appropriée
 * pour styliser le badge en fonction de l'état spécifié.
 *
 * @param {string} data - Le texte de l'état pour le badge.
 *                        Les valeurs possibles incluent 'Actif', 'Inactif',
 *                        'En attente', 'Approuvé', 'Rejeté', 'En cours',
 *                        'Terminé', 'En pause', 'À venir', 'Expiré',
 *                        'Supprimé', 'Archivé', 'En traitement', 'Expédié',
 *                        'Livré', 'Annulé', 'Remboursé', 'Retourné',
 *                        'Payer', 'En attente de paiement', 'Paiement reçu',
 *                        'Paiement en cours', 'Échec du paiement',
 *                        'Remboursement initié', 'Remboursement terminé'.
 * @returns {string} - Une chaîne HTML contenant un élément `<span>` avec
 *                     la classe CSS appropriée pour l'état fourni, et le texte
 *                     de l'état à l'intérieur du `<span>`.
 *
 * @example
 * // Exemple d'utilisation de la fonction
 * const badgeHtml = getBadgeHtml('En attente');
 * document.getElementById('badge-container').innerHTML = badgeHtml;
 */
export function getBadgeHtml(data, width) {
    let className;

    switch(data.trim()) {
        case 'Actif':
            className = 'badge badge-status badge-actif';
            break;
        case 'Inactif':
            className = 'badge badge-status badge-inactif';
            break;
        case 'En attente':
            className = 'badge badge-status badge-en-attente';
            break;
        case 'Approuvé':
            className = 'badge badge-status badge-approuve';
            break;
        case 'Rejeté':
            className = 'badge badge-status badge-rejete';
            break;
        case 'En cours':
            className = 'badge badge-status badge-en-cours';
            break;
        case 'Terminé':
            className = 'badge badge-status badge-termine';
            break;
        case 'En pause':
            className = 'badge badge-status badge-en-pause';
            break;
        case 'À venir':
            className = 'badge badge-status badge-a-venir';
            break;
        case 'Expiré':
            className = 'badge badge-status badge-expire';
            break;
        case 'Supprimé':
            className = 'badge badge-status badge-supprime';
            break;
        case 'Archivé':
            className = 'badge badge-status badge-archive';
            break;
        case 'En traitement':
            className = 'badge badge-status badge-en-traitement';
            break;
        case 'Expédié':
            className = 'badge badge-status badge-expedie';
            break;
        case 'Livré':
            className = 'badge badge-status badge-livre';
            break;
        case 'Annulé':
            className = 'badge badge-status badge-annule';
            break;
        case 'Remboursé':
            className = 'badge badge-status badge-rembourse';
            break;
        case 'Retourné':
            className = 'badge badge-status badge-retourne';
            break;
        case 'Payer':
            className = 'badge badge-status badge-payer';
            break;
        case 'En attente de paiement':
            className = 'badge badge-status badge-en-attente-de-paiement';
            break;
        case 'Paiement reçu':
            className = 'badge badge-status badge-paiement-recu';
            break;
        case 'Paiement en cours':
            className = 'badge badge-status badge-paiement-en-cours';
            break;
        case 'Échec du paiement':
            className = 'badge badge-status badge-echec-du-paiement';
            break;
        case 'Remboursement initié':
            className = 'badge badge-status badge-remboursement-initie';
            break;
        case 'Remboursement terminé':
            className = 'badge badge-status badge-remboursement-termine';
            break;
        default:
            className = 'badge badge-status badge-default';
            break;
    }

    return `<span class="${className}" style="width: ${width}">${data}</span>`;
}
