# GoodBites - E-commerce con Sistema Ibrido di Login

Sito e-commerce per fast food con **sistema ibrido**: ordina come ospite o registrati per vantaggi esclusivi.

---

## 🎯 Sistema Ibrido - Come Funziona

### Utenti Ospiti (Guest)
✅ Navigazione libera senza login
✅ Carrello completo
✅ Guest checkout (solo nome ed email)
✅ Email di conferma ordine

### Utenti Registrati
⭐ **10% di sconto** sul primo ordine
⭐ **Punti fedeltà** (10 punti per ordine)
⭐ Checkout veloce (dati salvati)
⭐ Cronologia ordini
⭐ Offerte esclusive

---

## 📱 User Journey

### Ospite
1. Homepage → Banner "Registrati per 10% sconto"
2. Naviga e aggiunge al carrello
3. Checkout → "Checkout come ospite o Accedi"
4. Ordina inserendo nome, email, indirizzo
5. Riceve email con invito a registrarsi

### Membro
1. Login → "Benvenuto! Guadagna punti"
2. Carrello e checkout
3. Dati pre-compilati
4. Completa ordine → "Hai guadagnato 10 punti!"
5. Email con saldo punti

---

## ✨ Caratteristiche

### 1. Catalogo Prodotti (`index.php`)
- 15 prodotti, 4 categorie
- Banner vantaggi per ospiti
- Badge membro per loggati

### 2. Carrello (`cart.php`)
- Icona con badge (top-right)
- Suggerimento login discreto
- Checkout per tutti

### 3. Autenticazione
- Login/Register/Logout
- Sessioni persistenti
- Password criptate

### 4. Checkout (`checkout.php`)
- Guest: nome ed email richiesti
- Member: dati pre-compilati
- Form dinamico

### 5. Email Personalizzate
- Ospiti: invito registrazione
- Membri: punti guadagnati
- Template HTML

---

## 🛠️ Struttura File

```
burgerqueen/
├── index.php              # Homepage
├── cart.php               # Carrello
├── checkout.php           # Guest/Member checkout
├── login.php              # Login
├── register.php           # Registrazione
├── assets/mycss/          # CSS
├── includes/              # PHP functions
└── data/                  # Prodotti e utenti
```

---

## 🚀 Setup

1. **Avvia server**
   ```bash
   cd burgerqueen
   php -S localhost:8000
   ```

2. **Test credenziali**
   ```
   Email: user@test.com
   Password: user123
   ```

3. **Testa flussi**
   - Ordina come ospite
   - Registrati e ordina come membro

---

## 📊 Vantaggi Sistema Ibrido

✅ Massimizza conversioni (no barriere)
✅ Incentiva fedeltà (vantaggi chiari)
✅ Raccoglie email (sempre)
✅ Segmentazione marketing (guest/member)

---

## 📝 Requisiti Assignment Soddisfatti

✅ E-commerce con vendita prodotti
✅ Gestione carrello completa
✅ Sistema login
✅ Invio email ordini

### Bonus
⭐ Sistema ibrido guest/member
⭐ Programma fedeltà
⭐ Email personalizzate
⭐ UX ottimizzata

---

**BurgerQueen** - Ordina liberamente, torna per i vantaggi! 👑🍔
