CREATE DATABASE IF NOT EXISTS portal_alumni CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portal_alumni;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    user_type ENUM('mahasiswa', 'alumni') NOT NULL DEFAULT 'mahasiswa',
    nim VARCHAR(255) NULL UNIQUE,
    phone VARCHAR(255) NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE user_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    address TEXT NULL,
    graduation_year SMALLINT UNSIGNED NULL,
    study_program VARCHAR(255) NULL,
    education_history TEXT NULL,
    skills TEXT NULL,
    work_experience TEXT NULL,
    current_company VARCHAR(255) NULL,
    current_position VARCHAR(255) NULL,
    linkedin_url VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_user_profiles_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE job_vacancies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    employment_type ENUM('full-time', 'part-time', 'internship', 'contract') NOT NULL DEFAULT 'full-time',
    salary_min DECIMAL(15,2) NULL,
    salary_max DECIMAL(15,2) NULL,
    deadline DATE NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    description TEXT NOT NULL,
    requirements TEXT NULL,
    application_link VARCHAR(255) NULL,
    created_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_job_vacancies_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE career_events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    event_type VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    quota INT UNSIGNED NULL,
    is_published TINYINT(1) NOT NULL DEFAULT 1,
    description TEXT NOT NULL,
    created_by BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_career_events_user FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE event_registrations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    career_event_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    status ENUM('registered', 'attended', 'cancelled') NOT NULL DEFAULT 'registered',
    registered_at DATETIME NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY unique_event_user (career_event_id, user_id),
    CONSTRAINT fk_event_registrations_event FOREIGN KEY (career_event_id) REFERENCES career_events(id) ON DELETE CASCADE,
    CONSTRAINT fk_event_registrations_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tracer_studies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    employment_status ENUM('bekerja', 'wirausaha', 'studi_lanjut', 'belum_bekerja') NOT NULL,
    company_name VARCHAR(255) NULL,
    job_title VARCHAR(255) NULL,
    relevance_level TINYINT UNSIGNED NOT NULL,
    waiting_period_months INT UNSIGNED NOT NULL DEFAULT 0,
    salary DECIMAL(15,2) NULL,
    feedback TEXT NULL,
    survey_year YEAR NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY unique_tracer_user_year (user_id, survey_year),
    CONSTRAINT fk_tracer_studies_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE system_notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type ENUM('job', 'event', 'system') NOT NULL DEFAULT 'system',
    user_id BIGINT UNSIGNED NULL,
    published_at DATETIME NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_system_notifications_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
