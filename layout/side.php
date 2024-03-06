<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                          fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>
    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item <?php if($lien == 'sortie' || $lien == ''){echo 'current';} ;?>" data-bs-toggle="slide" href="<?=$domaine_admin?>/sortie"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Sortie détente</span></a>
        </li>

        <li class="slide">
            <a class="side-menu__item <?php if($lien == 'carte' || $lien == ''){echo 'current';} ;?>" data-bs-toggle="slide" href="<?=$domaine_admin?>/carte"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Carte de membre</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item <?php if($lien == 'statitisque' || $lien == ''){echo 'current';} ;?>" data-bs-toggle="slide" href="<?=$domaine_admin?>/statitisque"><i
                    class="side-menu__icon fe fe-home"></i><span
                    class="side-menu__label">Statitisque</span></a>
        </li>
        <li class="slide">
            <a class="side-menu__item <?php if($lien == 'reunion' || $lien == ''){echo 'current';} ;?>" data-bs-toggle="slide" href="<?=$domaine_admin?>/reunion"><i
                    class="side-menu__icon fe fe-user"></i><span
                    class="side-menu__label">Réunion</span></a>
        </li>



    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                                   width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>