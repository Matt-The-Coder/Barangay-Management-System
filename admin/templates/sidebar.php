<?php // function to get the current page name
function PageName()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$current_page = PageName();
?>
<div class="sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner bg-dark-gradient">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm">
                    <?php if (!empty($_SESSION['avatar'])) : ?>
                        <img id="image" src="<?= preg_match('/data:image/i', $_SESSION['avatar']) ? $_SESSION['avatar'] : 'assets/uploads/avatar/' . $_SESSION['avatar'] ?>" alt="..." class="avatar-img rounded-circle">
                    <?php else : ?>
                        <img src="assets/img/person.png" alt="..." class="avatar-img rounded-circle">
                    <?php endif ?>
                </div>
                <div class="info">
                    <a data-bs-toggle="collapse" class="text-decoration-none" href="<?= isset($_SESSION['username']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff') ? '#collapseExample' : 'javascript:void(0)' ?>" aria-expanded="true">
                        <span id="username">
                            <?= isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'Guest User' ?>
                        </span>
                        <span id="role" class="user-level"><?= isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest' ?></span>
                        <?= isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff') ? '<span class="caret"></span>' : null ?>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit_profile" data-bs-toggle="modal" class="text-decoration-none">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                                <a href="#changepass" data-bs-toggle="modal" class="text-decoration-none">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                                <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'administrator' || $_SESSION['role'] == 'staff')) : ?>
                                    <a href="model/logout.php" class="text-decoration-none">
                                        <span class="link-collapse">Sign Out</span>
                                    </a>
                                <?php else : ?>
                                    <a href="login.php" class="see-all">Sign In<i class="icon-login"></i></a>
                                <?php endif ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-danger">
                <li class="nav-item <?= $current_page == 'dashboard.php' || $current_page == 'resident_info.php' || $current_page == 'purok_info.php'  ? 'active' : null ?>">
                    <a href="dashboard.php" class="text-decoration-none">
                        <i class="ri-dashboard-line fs-3"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item <?= $current_page == 'officials.php' ? 'active' : null ?>">
                    <a href="officials.php" class="text-decoration-none">
                        <i class="ri-user-2-line fs-3"></i>
                        <p>Brgy. Officials and Staff</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'resident.php' || $current_page == 'generate_resident.php' ? 'active' : null ?>">
                    <a href="resident.php" class="text-decoration-none">
                        <i class="ri-group-line fs-3"></i>
                        <p>Resident Information</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'resident_certification.php' || $current_page == 'generate_brgy_cert.php' ? 'active' : null ?>">
                    <a href="resident_certification.php" class="text-decoration-none">
                        <i class="ri-award-line fs-3"></i>
                        <p>Barangay Certificates</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'resident_indigency.php' || $current_page == 'generate_indi_cert.php' ? 'active' : null ?>">
                    <a href="resident_indigency.php" class="text-decoration-none">
                        <i class="ri-file-text-line fs-3"></i>
                        <p>Certificate of Indigency</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'business_permit.php' || $current_page == 'generate_business_permit.php' ? 'active' : null ?>">
                    <a href="business_permit.php" class="text-decoration-none">
                        <i class="ri-file-paper-2-line fs-3"></i>
                        <p>Business Permit</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'request.php' ? 'active' : null ?>">
                    <a href="request.php" class="text-decoration-none">
                        <i class="ri-file-copy-2-line fs-3"></i>
                        <p>Requested Documents</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'household_info.php' ? 'active' : null ?>">
                    <a href="household_info.php" class="text-decoration-none">
                        <i class="ri-home-6-line fs-3"></i>
                        <p>Household</p>
                    </a>
                </li>
                <li class="nav-item <?= $current_page == 'blotter.php' ? 'active' : null ?>">
                    <a href="blotter.php" class="text-decoration-none">
                        <i class="ri-stack-line fs-3"></i>
                        <p>Blotter</p>
                    </a>
                </li>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'staff') : ?>
                    <li class="nav-section" class="text-decoration-none">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">System</h4>
                    </li>
                    <li class="nav-item">
                        <a href="#support" data-bs-toggle="modal">
                            <i class="ri-customer-service-2-line fs-3"></i>
                            <p>Support</p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                    <li class="nav-item <?= $current_page == 'revenue.php' ? 'active' : null ?>">
                        <a href="revenue.php" class="text-decoration-none">
                            <i class="ri-wallet-line fs-3"></i>
                            <p>Revenues</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">System</h4>
                    </li>
                    <li class="nav-item <?= $current_page == 'purok.php' || $current_page == 'position.php' || $current_page == 'chairmanship.php' || $current_page == 'precinct.php' || $current_page == 'users.php' || $current_page == 'support.php' || $current_page == 'backup.php' ? 'active' : null ?>">
                        <a href="#settings" data-bs-toggle="collapse" class="collapsed text-decoration-none" aria-expanded="false">
                            <i class="ri-settings-line fs-3"></i>
                            <p>Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= $current_page == 'purok.php' || $current_page == 'household.php' || $current_page == 'position.php'  || $current_page == 'precinct.php' || $current_page == 'chairmanship.php' || $current_page == 'users.php' || $current_page == 'support.php' || $current_page == 'backup.php' ? 'show' : null ?>" id="settings">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="#barangay" data-bs-toggle="modal" class="text-decoration-none">
                                        <span class="sub-item">Barangay Information</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page == 'purok.php' ? 'active' : null ?>">
                                    <a href="purok.php" class="text-decoration-none">
                                        <span class="sub-item">Purok</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page == 'household.php' ? 'active' : null ?>">
                                    <a href="household.php" class="text-decoration-none">
                                        <span class="sub-item">Household Information</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page == 'precinct.php' ? 'active' : null ?>">
                                    <a href="precinct.php" class="text-decoration-none">
                                        <span class="sub-item">Precinct</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page == 'position.php' ? 'active' : null ?>">
                                    <a href="position.php" class="text-decoration-none">
                                        <span class="sub-item">Positions</span>
                                    </a>
                                </li>
                                <li class="<?= $current_page == 'chairmanship.php' ? 'active' : null ?>">
                                    <a href="chairmanship.php" class="text-decoration-none">
                                        <span class="sub-item">Chairmanship</span>
                                    </a>
                                </li>

                                <?php if ($_SESSION['role'] == 'staff') : ?>
                                    <li>
                                        <a href="#support" data-bs-toggle="modal" class="text-decoration-none">
                                            <span class="sub-item">Support</span>
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li class="<?= $current_page == 'users.php' ? 'active' : null ?>">
                                        <a href="users.php" class="text-decoration-none">
                                            <span class="sub-item">Users</span>
                                        </a>
                                    </li>
                                    <li class="<?= $current_page == 'support.php' ? 'active' : null ?>">
                                        <a href="support.php" class="text-decoration-none">
                                            <span class="sub-item">Support</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="backup/backup.php" class="text-decoration-none">
                                            <span class="sub-item">Backup</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#restore" data-bs-toggle="modal" class="text-decoration-none">
                                            <span class="sub-item">Restore</span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>