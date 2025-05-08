package controllers

import (
	"log"
	"net/http"
	"strings"
	"time"

	"flutter_api/database"
	"flutter_api/models"
	"github.com/gin-gonic/gin"
	"github.com/go-playground/validator/v10"
)

type ProfileController struct{}

// UpdateProfileRequest adalah struct untuk request update profil
type UpdateProfileRequest struct {
	Name      string `json:"name" binding:"required,min=3,max=50"`
	Email     string `json:"email" binding:"required,email"`
	Address   string `json:"address" binding:"required"`
	Job       string `json:"job" binding:"required"`
	Birthdate string `json:"birthdate" binding:"required"` // Ubah ke string
	Photo     string `json:"photo"`
}

// CreateProfile untuk menangani pembuatan profil baru
func (pc *ProfileController) CreateProfile(c *gin.Context) {
	var input UpdateProfileRequest

	// Binding data JSON ke struct UpdateProfileRequest
	if err := c.ShouldBindJSON(&input); err != nil {
		log.Println("Binding error:", err) // Log error binding
		c.JSON(http.StatusBadRequest, gin.H{
			"status":  "error",
			"message": "Validasi gagal",
			"errors":  parseValidationError(err),
		})
		return
	}

	// Pastikan email menjadi lowercase dan menghapus spasi yang tidak perlu
	input.Email = strings.TrimSpace(strings.ToLower(input.Email))

	// Parse tanggal dari string ke time.Time
	birthdate, err := time.Parse("2006-01-02", input.Birthdate)
	if err != nil {
		log.Println("Error parsing date:", err)
		c.JSON(http.StatusBadRequest, gin.H{
			"status":  "error",
			"message": "Format tanggal tidak valid. Gunakan format YYYY-MM-DD",
		})
		return
	}

	// Membuat objek profil baru
	profile := models.Profile{
		UserID:    1, // UserID bisa diganti dengan ID pengguna yang terautentikasi
		Name:      input.Name,
		Email:     input.Email,
		Address:   input.Address,
		Job:       input.Job,
		Birthdate: birthdate, // Gunakan tanggal yang sudah di-parse
		Photo:     input.Photo,
	}

	// Menyimpan profil ke dalam database
	if err := database.DB.Create(&profile).Error; err != nil {
		log.Printf("Failed to save profile: %v", err) // Log error saat menyimpan profil
		c.JSON(http.StatusInternalServerError, gin.H{
			"status":  "error",
			"message": "Gagal menyimpan profil",
		})
		return
	}

	// Response sukses jika profil berhasil dibuat
	c.JSON(http.StatusCreated, gin.H{
		"status":  "success",
		"message": "Profil berhasil dibuat",
		"data":    profile,
	})
}

// UpdateProfile untuk menangani pembaruan profil berdasarkan user_id
func (pc *ProfileController) UpdateProfile(c *gin.Context) {
	var input UpdateProfileRequest
	userID := c.Param("user_id")

	// Binding data JSON ke struct UpdateProfileRequest
	if err := c.ShouldBindJSON(&input); err != nil {
		log.Println("Binding error:", err) // Log error binding
		c.JSON(http.StatusBadRequest, gin.H{
			"status":  "error",
			"message": "Validasi gagal",
			"errors":  parseValidationError(err),
		})
		return
	}

	// Mencari profil berdasarkan user_id
	var profile models.Profile
	if err := database.DB.Where("user_id = ?", userID).First(&profile).Error; err != nil {
		log.Printf("Profile not found: %v", err) // Log error jika profil tidak ditemukan
		c.JSON(http.StatusNotFound, gin.H{
			"status":  "error",
			"message": "Profil tidak ditemukan",
		})
		return
	}

	// Parse tanggal dari string ke time.Time
	birthdate, err := time.Parse("2006-01-02", input.Birthdate)
	if err != nil {
		log.Println("Error parsing date:", err)
		c.JSON(http.StatusBadRequest, gin.H{
			"status":  "error",
			"message": "Format tanggal tidak valid. Gunakan format YYYY-MM-DD",
		})
		return
	}

	// Memperbarui data profil
	profile.Name = input.Name
	profile.Email = input.Email
	profile.Address = input.Address
	profile.Job = input.Job
	profile.Birthdate = birthdate // Gunakan tanggal yang sudah di-parse
	profile.Photo = input.Photo

	// Menyimpan perubahan ke database
	if err := database.DB.Save(&profile).Error; err != nil {
		log.Printf("Failed to update profile: %v", err) // Log error saat update profil
		c.JSON(http.StatusInternalServerError, gin.H{
			"status":  "error",
			"message": "Gagal mengupdate profil",
		})
		return
	}

	// Response sukses jika profil berhasil diperbarui
	c.JSON(http.StatusOK, gin.H{
		"status":  "success",
		"message": "Profil berhasil diperbarui",
		"data":    profile,
	})
}

// Fungsi untuk parse error validasi
func parseValidationError(err error) map[string]string {
	errors := make(map[string]string)
	if errs, ok := err.(validator.ValidationErrors); ok {
		for _, e := range errs {
			field := strings.ToLower(e.Field())
			switch e.Tag() {
			case "required":
				errors[field] = "Wajib diisi"
			case "email":
				errors[field] = "Format email tidak valid"
			case "min":
				errors[field] = "Minimal " + e.Param() + " karakter"
			case "max":
				errors[field] = "Maksimal " + e.Param() + " karakter"
			default:
				errors[field] = "Format tidak valid"
			}
		}
	}
	return errors
}