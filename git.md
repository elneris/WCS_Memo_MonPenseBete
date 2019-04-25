### Configuration

#### Utilisateur

Git a besoin de savoir qui est le développeur qui fait des commits.

Ouvrir un terminal :

    git config --global user.name "[nom-du-développeur]"
    git config --global user.email "[email-du-développeur]"

## Notions à connaître

- repository ou repo : projet géré par git
- dossier `.git` : le dossier qui contient toutes les données du repo
- fichier `.gitignore` : fichier qui contient la liste des fichiers que git ne prendra pas en compte quand on fait un `git status` ou un `git diff`; on peut aussi forcer la prise en compte de fichiers qui se trouvent dans des dossiers ignorés
- remote : repo distant
- origin : alias / pseudo du repo distant (github ou framagit par exemple) - local : repo sur un poste de travail
- commiter : enregistrer des modifications faites sur des fichiers ou des dossiers
- message de commit : ce message permet de comprendre en quoi consiste les modifications
- zone de staging : sous-dossier du dossier `.git` dans lequel git copie les fichiers quand on utilise la commande `git add`; ce sont les fichiers de cette zone qui sont commités
- branches : versions différentes d'un même projet
- branche master : la branche principale, c'est la branche par défaut
- merger : mixer le code source de deux branches
- pull request / merge request / PR : demande de code review avant de merger le code
- rebaser : couper une branche et la « re-baser » (faire une bouture) sur un autre commit
- stash : la remise; zone où l'on peut stocker temporairement des modifications en cours

## Types de branches

- fonctionnalité
- correction de bug
- documentation
- maintenance (modifications sans impact fonctionnel)

- `f-` : fonctionnalité
- `b-` : correction de bug
- `d-` : documentation
- `m-` : maintenance

Cela permet de :

- repérer facilement le type de changement qui sera commité
- empêcher de corriger des bugs dans une branche de fonctionnalité
- plannifier les activités

## Commandes à connaître

- `git status` : affiche le nom de la branche courante, la synchronisation avec `origin` et l'état des fichiers
- `git log` : affiche la liste des commits
- `git show` : affiche les modifications enregistrées dans le dernier commit
- `git diff` : affiche les différences entre deux commits
- `git add` : notifie à git les fichier qu'on veut commiter, c-à-d copie les fichiers dans la zone de staging
- `git reset` : notifie à git les fichier qu'on veut plus commiter, c-à-d supprime les fichiers de la zone de staging
- `git commit` : enregistre les modification
- `git clone` : duplique un repo dans le dossier courant
- `git push` : pousse les modification du repo local dans le repo distant
- `git pull` : rappatrie dans le repo local les modification du repo distant
- `git checkout [nom-de-fichier]` : restaure un fichier dans son état avant modification, c-a-d annule les modifications
- `git branch` : manipule les branches (création, suppression, liste)
- `git checkout [nom-de-branche]` : change de branche pour aller dans `[nom-de-branche]`
- `git merge [nom-de-branche]` : mixe le code de la branche `[nom-de-branche]` dans la branche courante
- `git rebase master` : couper la branche courante et la rebaser sur le dernier commit de la branche master


## `.gitignore`

Ce fichier dit à Git de ne pas tenir compte de certain fichier.
Ou de force le prise en compte de fichiers se trouvant dans un dossier ignoré.

Dans votre fichier `.gitignore` :

    /config/db.yml
    /config/mail.yml
    /cache/*
    !cache/.gitkeep

### Création du repo en local

    # todo: créer le dossier du projet
    # todo: créer un fichier README.md dans le dossier du projet
    # todo: ouvrir un terminal
    cd [dossier-du-projet]
    # initialiser le repo git
    git init
    # ajouter tous les fichiers dans la zone de staging
    git add .
    # créer un premier commit
    git commit -m "Création du repo"


### Enregistrer des modifications

Par exemple, un commit peut contenir :

- la création d'une fonctionnalité (mais surtout pas plusieurs)
- l'amélioration d'une fonctionnalité
- la suppression d'une fonctionnalité
- une correction de bug
- plusieurs corrections d'orthographe
- la création de documentation
- l'amélioration de documentation
- la suppression de documentation

D'abord on ajoute les fichiers dans la zone de staging.

    # ajouter un seul fichier
    git add [nom-du-fichier]

    # ajouter plusieurs fichiers :
    git add [nom-du-fichier1] [nom-du-fichier2] [nom-du-fichier3] [...]


On vérifie que tout ce qu'on veut commiter a bien été ajouté dans la zone de staging.

    # vérifier les fichiers qui seront commités
    git status
    # vérifier le code qui sera commité
    git diff --staged

Si on se rend compte qu'on a ajouter par erreur un fichier, on peut le supprimer de la zone de staging.

    # notifier git de ne pas commiter le fichier [nom-du-fichier]
    git reset [nom-du-fichier]

Puis on commit.

    # commiter en spécifiant juste un titre de commit
    git commit -m "Ajout de la fonctionnalité"

### Publier des modifications

    # pousser les modifications de la branche courante sur la branche [nom-de-branche] du repo distant et demander à git de retenir cette configuration
    git push -u origin [nom-de-branche]

    # pousser les modifications de la branche courante sur la branche par défaut du repo distant (configurée au préalable)
    git push

### Vérifier l'état du repo local

    # synchroniser les dossiers `.git` du repo distant et du repo local
    git fetch
    # vérifier de la branche courante, des commits en avance (ou pas) et des modifications en cours
    git status

    # afficher des modifications en cours (qui ne seront pas commitées)
    git diff
    # afficher des modifications qui seront commitées
    git diff --staged

    # afficher la liste des commits (en ordre anti-chronologique) avec les commentaires
    git log
    # afficher la liste simplifiée des commits (sans les commentaires)
    git log --oneline