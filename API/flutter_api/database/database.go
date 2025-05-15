package database

import (
	"flutter_api/models"
	"fmt"
	"log"
	"os"
	"time"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
	"gorm.io/gorm/logger"
)

var DB *gorm.DB

func InitDB() *gorm.DB {
	// Konfigurasi logger
	newLogger := logger.New(
		log.New(os.Stdout, "\r\n", log.LstdFlags),
		logger.Config{
			SlowThreshold:             time.Second,
			LogLevel:                  logger.Info,
			IgnoreRecordNotFoundError: true,
			Colorful:                  true,
		},
	)

	// Konfigurasi koneksi database
	// Gunakan environment variable jika tersedia
	dbUser := getEnv("DB_USER", "root")
	dbPass := getEnv("DB_PASS", "")
	dbHost := getEnv("DB_HOST", "127.0.0.1")
	dbPort := getEnv("DB_PORT", "3307")
	dbName := getEnv("DB_NAME", "laravel")

	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?parseTime=true&charset=utf8mb4&loc=Local",
		dbUser, dbPass, dbHost, dbPort, dbName)

	var err error

	// Buka koneksi database
	DB, err = gorm.Open(mysql.Open(dsn), &gorm.Config{
		Logger: newLogger,
	})
	if err != nil {
		fmt.Println("Gagal terhubung ke database:", err)
		panic("Tidak bisa terhubung ke database!")
	}
	fmt.Println("Koneksi database berhasil")

	// Aktifkan mode debug
	DB = DB.Debug()

	// Konfigurasi koneksi pool
	sqlDB, err := DB.DB()
	if err != nil {
		fmt.Println("Error mendapatkan koneksi database:", err)
		panic("Gagal mendapatkan koneksi database")
	}

	// Cek koneksi dengan ping
	if err := sqlDB.Ping(); err != nil {
		fmt.Println("Error ping database:", err)
		panic("Ping database gagal")
	}
	fmt.Println("Ping database berhasil")

	// Konfigurasi pool koneksi
	sqlDB.SetMaxIdleConns(10)
	sqlDB.SetMaxOpenConns(100)
	sqlDB.SetConnMaxLifetime(time.Hour)

	// Migrasi model
	if err := DB.AutoMigrate(
		&models.User{},
		&models.Profile{},
		&models.WorkExperience{},
		&models.HelpRequest{},
		&models.JobPosting{}, // Menambahkan model JobPosting
	); err != nil {
		fmt.Println("Error AutoMigrate:", err)
		panic("Gagal melakukan migrasi tabel")
	}
	fmt.Println("Migrasi tabel berhasil")

	return DB
}

// GetDB mengembalikan instance database yang sudah diinisialisasi
func GetDB() *gorm.DB {
	if DB == nil {
		return InitDB()
	}
	return DB
}

// getEnv mengambil nilai environment variable atau nilai default jika tidak ada
func getEnv(key, defaultValue string) string {
	value := os.Getenv(key)
	if value == "" {
		return defaultValue
	}
	return value
}
