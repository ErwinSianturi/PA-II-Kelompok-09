package database

import (
	"flutter_api/models"
	"fmt"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
	"gorm.io/gorm/logger"
	"log"
	"os"
	"time"
)

var DB *gorm.DB

func InitDB() *gorm.DB {

	newLogger := logger.New(
		log.New(os.Stdout, "\r\n", log.LstdFlags),
		logger.Config{
			SlowThreshold:             time.Second,
			LogLevel:                  logger.Info,
			IgnoreRecordNotFoundError: true,
			Colorful:                  true,
		},
	)

	dsn := "root:@tcp(127.0.0.1:3306)/laravel?parseTime=true&charset=utf8mb4&loc=Local"
	var err error

	DB, err = gorm.Open(mysql.Open(dsn), &gorm.Config{
		Logger: newLogger,
	})
	if err != nil {
		fmt.Println("Gagal terhubung ke database:", err)
		panic("Tidak bisa terhubung ke database!")
	}
	fmt.Println("Koneksi database berhasil")

	DB = DB.Debug()

	sqlDB, err := DB.DB()
	if err != nil {
		fmt.Println("Error mendapatkan koneksi database:", err)
		panic("Gagal mendapatkan koneksi database")
	}

	if err := sqlDB.Ping(); err != nil {
		fmt.Println("Error ping database:", err)
		panic("Ping database gagal")
	}
	fmt.Println("Ping database berhasil")

	sqlDB.SetMaxIdleConns(10)
	sqlDB.SetMaxOpenConns(100)
	sqlDB.SetConnMaxLifetime(time.Hour)

	if err := DB.AutoMigrate(
		&models.User{},
		&models.Profile{},
		&models.WorkExperience{},
		&models.HelpRequest{},
	); err != nil {
		fmt.Println("Error AutoMigrate:", err)
		panic("Gagal melakukan migrasi tabel")
	}
	fmt.Println("Migrasi tabel berhasil")

	return DB
}

func GetDB() *gorm.DB {
	if DB == nil {
		return InitDB()
	}
	return DB
}
