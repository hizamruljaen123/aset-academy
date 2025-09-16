import random
from faker import Faker
from datetime import datetime, timedelta
import hashlib

fake = Faker('id_ID')  # Using Indonesian locale for more relevant data

# Database connection would go here if needed
# For now, we'll generate SQL INSERT statements

def generate_users(num_users=50):
    """Generate users data"""
    users = []
    roles = ['super_admin', 'admin', 'guru', 'siswa', 'user']
    levels = ['1', '2', '3', '4', '5']

    for i in range(1, num_users + 1):
        role = random.choice(roles)
        level = levels[roles.index(role)] if role in roles else '5'
        password = hashlib.md5(f"password{i}".encode()).hexdigest()

        user = {
            'id': i,
            'username': fake.user_name() + str(i),
            'password': password,
            'nama_lengkap': fake.name(),
            'email': fake.email(),
            'role': role,
            'level': level,
            'department': fake.company() if random.random() > 0.5 else None,
            'status': random.choice(['Aktif', 'Tidak Aktif']),
            'last_login': fake.date_time_this_year() if random.random() > 0.3 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        users.append(user)

    return users

def generate_siswa(num_siswa=30):
    """Generate siswa (students) data"""
    siswa = []
    jurusan = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Manajemen Informatika']
    kelas = ['X', 'XI', 'XII']

    for i in range(1, num_siswa + 1):
        siswa_data = {
            'id': i,
            'nis': f"{random.randint(100000, 999999)}",
            'nama_lengkap': fake.name(),
            'email': fake.email(),
            'no_telepon': fake.phone_number(),
            'kelas': f"{random.choice(kelas)} {random.choice(jurusan)}",
            'jurusan': random.choice(jurusan),
            'alamat': fake.address(),
            'foto_profil': f"/uploads/profiles/student_{i}.jpg" if random.random() > 0.5 else None,
            'tanggal_lahir': fake.date_of_birth(minimum_age=15, maximum_age=25),
            'jenis_kelamin': random.choice(['L', 'P']),
            'status': random.choice(['Aktif', 'Tidak Aktif', 'Lulus']),
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        siswa.append(siswa_data)

    return siswa

def generate_kelas_programming(num_kelas=10):
    """Generate kelas_programming data"""
    kelas = []
    bahasa_program = ['Python', 'JavaScript', 'Java', 'PHP', 'C++', 'C#', 'Ruby', 'Go']
    levels = ['Dasar', 'Menengah', 'Lanjutan']

    for i in range(1, num_kelas + 1):
        kelas_data = {
            'id': i,
            'nama_kelas': f"Kelas {random.choice(bahasa_program)} {random.choice(levels)}",
            'deskripsi': fake.paragraph(),
            'level': random.choice(levels),
            'bahasa_program': random.choice(bahasa_program),
            'durasi': random.randint(20, 100),
            'harga': round(random.uniform(500000, 5000000), 2),
            'gambar': f"/uploads/classes/class_{i}.jpg" if random.random() > 0.5 else None,
            'status': random.choice(['Aktif', 'Tidak Aktif']),
            'online_meet_link': fake.url() if random.random() > 0.7 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        kelas.append(kelas_data)

    return kelas

def generate_jadwal_kelas(kelas_ids, guru_ids, num_jadwal=50):
    """Generate jadwal_kelas data"""
    jadwal = []

    for i in range(1, num_jadwal + 1):
        start_time = datetime.strptime(f"{random.randint(8,17):02d}:{random.randint(0,59):02d}:00", "%H:%M:%S").time()
        duration = random.randint(1, 4) * 60 * 60  # 1-4 hours in seconds
        end_time = (datetime.combine(datetime.today(), start_time) + timedelta(seconds=duration)).time()

        jadwal_data = {
            'id': i,
            'kelas_id': random.choice(kelas_ids),
            'pertemuan_ke': random.randint(1, 20),
            'class_type': random.choice(['premium', 'gratis']) if random.random() > 0.5 else None,
            'guru_id': random.choice(guru_ids) if random.random() > 0.8 else None,
            'judul_pertemuan': fake.sentence(),
            'tanggal_pertemuan': fake.date_this_year(),
            'waktu_mulai': start_time,
            'waktu_selesai': end_time,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        jadwal.append(jadwal_data)

    return jadwal

def generate_absensi(jadwal_ids, siswa_ids, num_absensi=200):
    """Generate absensi data"""
    absensi = []
    statuses = ['Hadir', 'Izin', 'Sakit', 'Alpa']

    for i in range(1, num_absensi + 1):
        absensi_data = {
            'id': i,
            'jadwal_id': random.choice(jadwal_ids),
            'siswa_id': random.choice(siswa_ids),
            'status': random.choice(statuses),
            'catatan': fake.sentence() if random.random() > 0.5 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        absensi.append(absensi_data)

    return absensi

def generate_absensi_guru(jadwal_ids, guru_ids, num_absensi=100):
    """Generate absensi_guru data"""
    absensi = []
    statuses = ['Hadir', 'Tidak Hadir']

    for i in range(1, num_absensi + 1):
        absensi_data = {
            'id': i,
            'jadwal_id': random.choice(jadwal_ids),
            'guru_id': random.choice(guru_ids),
            'status': random.choice(statuses),
            'catatan': fake.sentence() if random.random() > 0.5 else None,
            'waktu_absensi': fake.date_time_this_year()
        }
        absensi.append(absensi_data)

    return absensi

def generate_payments(user_ids, kelas_ids, num_payments=20):
    """Generate payments data"""
    payments = []
    methods = ['Transfer', 'Cash', 'Other']

    for i in range(1, num_payments + 1):
        amount = round(random.uniform(500000, 5000000), 2)
        payments_data = {
            'id': i,
            'user_id': random.choice(user_ids),
            'class_id': random.choice(kelas_ids),
            'amount': amount,
            'payment_method': random.choice(methods),
            'bank_name': fake.company() if random.random() > 0.5 else None,
            'account_number': fake.iban()[:20] if random.random() > 0.5 else None,
            'payment_proof': f"/uploads/payments/proof_{i}.jpg" if random.random() > 0.7 else None,
            'status': random.choice(['Pending', 'Verified', 'Rejected']),
            'enrollment_status': random.choice(['Not Enrolled', 'Enrolled', 'Access Revoked']),
            'verified_by': random.choice(user_ids) if random.random() > 0.5 else None,
            'verified_at': fake.date_time_this_year() if random.random() > 0.5 else None,
            'notes': fake.paragraph() if random.random() > 0.3 else None,
            'enrollment_notes': fake.sentence() if random.random() > 0.4 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        payments.append(payments_data)

    return payments

def generate_premium_class_enrollments(kelas_ids, user_ids, payment_ids, num_enrollments=30):
    """Generate premium_class_enrollments data"""
    enrollments = []
    statuses = ['Pending', 'Active', 'Suspended', 'Completed', 'Cancelled']

    for i in range(1, num_enrollments + 1):
        enrollment_data = {
            'id': i,
            'class_id': random.choice(kelas_ids),
            'student_id': random.choice(user_ids),
            'payment_id': random.choice(payment_ids),
            'enrollment_date': fake.date_time_this_year(),
            'status': random.choice(statuses),
            'access_granted_by': random.choice(user_ids) if random.random() > 0.5 else None,
            'access_granted_at': fake.date_time_this_year() if random.random() > 0.5 else None,
            'access_expires_at': fake.date_time_this_year() if random.random() > 0.3 else None,
            'progress': random.randint(0, 100),
            'completion_date': fake.date_time_this_year() if random.random() > 0.4 else None,
            'notes': fake.paragraph() if random.random() > 0.3 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        enrollments.append(enrollment_data)

    return enrollments

def generate_forum_categories(num_categories=5):
    """Generate forum_categories data"""
    categories = []
    category_names = ['Pembahasan Umum', 'Pertanyaan Teknis', 'Proyek', 'Tips dan Trik', 'Pengumuman']

    for i in range(1, num_categories + 1):
        category_data = {
            'id': i,
            'name': category_names[i-1] if i <= len(category_names) else fake.words(2),
            'description': fake.paragraph(),
            'slug': fake.slug(),
            'created_at': fake.date_time_this_year()
        }
        categories.append(category_data)

    return categories

def generate_forum_threads(user_ids, category_ids, num_threads=20):
    """Generate forum_threads data"""
    threads = []

    for i in range(1, num_threads + 1):
        thread_data = {
            'id': i,
            'user_id': random.choice(user_ids),
            'category_id': random.choice(category_ids),
            'title': fake.sentence(),
            'content': '\n\n'.join(fake.paragraphs(3)),
            'views': random.randint(0, 1000),
            'is_pinned': random.choice([0, 1]),
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year(),
            'slug': fake.slug()
        }
        threads.append(thread_data)

    return threads

def generate_forum_posts(thread_ids, user_ids, num_posts=100):
    """Generate forum_posts data"""
    posts = []

    for i in range(1, num_posts + 1):
        posts_data = {
            'id': i,
            'thread_id': random.choice(thread_ids),
            'user_id': random.choice(user_ids),
            'parent_id': random.choice([None] + list(range(1, i))) if random.random() > 0.7 else None,
            'content': fake.paragraph(),
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        posts.append(posts_data)

    return posts

def generate_free_classes(user_ids, num_classes=15):
    """Generate free_classes data"""
    classes = []
    categories = ['Python', 'JavaScript', 'Web Development', 'Mobile Development', 'Data Science']
    levels = ['Dasar', 'Menengah', 'Lanjutan']

    for i in range(1, num_classes + 1):
        classes_data = {
            'id': i,
            'title': fake.sentence(),
            'description': '\n\n'.join(fake.paragraphs(2)),
            'thumbnail': f"/uploads/classes/free_{i}.jpg" if random.random() > 0.5 else None,
            'level': random.choice(levels),
            'category': random.choice(categories),
            'duration': random.randint(1, 8),
            'mentor_id': random.choice(user_ids) if random.random() > 0.8 else None,
            'max_students': random.randint(20, 100) if random.random() > 0.5 else None,
            'start_date': fake.date_this_year(),
            'end_date': fake.date_this_year(),
            'status': random.choice(['Draft', 'Published', 'Archived']),
            'online_meet_link': fake.url() if random.random() > 0.7 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        classes.append(classes_data)

    return classes

def generate_free_class_enrollments(class_ids, user_ids, num_enrollments=80):
    """Generate free_class_enrollments data"""
    enrollments = []
    statuses = ['Enrolled', 'Completed', 'Dropped']

    for i in range(1, num_enrollments + 1):
        enrollment_data = {
            'id': i,
            'class_id': random.choice(class_ids),
            'student_id': random.choice(user_ids),
            'enrollment_date': fake.date_time_this_year(),
            'status': random.choice(statuses),
            'progress': random.randint(0, 100),
            'completion_date': fake.date_time_this_year() if random.random() > 0.4 else None,
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year()
        }
        enrollments.append(enrollment_data)

    return enrollments

def generate_workshops(num_workshops=10):
    """Generate workshops data"""
    workshops = []
    types = ['workshop', 'seminar']

    for i in range(1, num_workshops + 1):
        start_datetime = fake.date_time_this_year()
        duration = timedelta(hours=random.randint(2, 8))
        end_datetime = start_datetime + duration

        workshop_data = {
            'id': i,
            'title': fake.sentence(),
            'slug': fake.slug(),
            'description': '\n\n'.join(fake.paragraphs(3)),
            'type': random.choice(types),
            'price': round(random.uniform(0, 1000000), 2),
            'start_datetime': start_datetime,
            'end_datetime': end_datetime,
            'location': fake.address(),
            'max_participants': random.randint(10, 200),
            'thumbnail': f"/uploads/workshops/workshop_{i}.jpg" if random.random() > 0.5 else None,
            'status': random.choice(['draft', 'published', 'completed']),
            'created_at': fake.date_time_this_year(),
            'updated_at': fake.date_time_this_year() if random.random() > 0.5 else None
        }
        workshops.append(workshop_data)

    return workshops

def generate_testimonials(num_testimonials=10):
    """Generate testimonials data"""
    testimonials = []
    positions = ['Mahasiswa', 'Developer', 'IT Manager', 'Student', 'Professional']

    for i in range(1, num_testimonials + 1):
        testimonial_data = {
            'id': i,
            'name': fake.name(),
            'position': random.choice(positions),
            'photo': f"/uploads/testimonials/testimonial_{i}.jpg" if random.random() > 0.5 else None,
            'content': fake.paragraph(),
            'rating': random.randint(3, 5),
            'created_at': fake.date_time_this_year()
        }
        testimonials.append(testimonial_data)

    return testimonials

def generate_sql_insert(table_name, data_list):
    """Generate SQL INSERT statements"""
    if not data_list:
        return ""

    columns = list(data_list[0].keys())
    sql = f"INSERT INTO `{table_name}` ({', '.join(f'`{col}`' for col in columns)}) VALUES\n"

    values_list = []
    for data in data_list:
        values = []
        for col in columns:
            value = data[col]
            if value is None:
                values.append('NULL')
            elif isinstance(value, str):
                values.append(f"'{value.replace("'", "''")}'")
            elif isinstance(value, datetime):
                values.append(f"'{value.strftime('%Y-%m-%d %H:%M:%S')}'")
            elif hasattr(value, 'strftime'):  # Handle date objects
                values.append(f"'{value.strftime('%Y-%m-%d')}'")
            elif isinstance(value, bool):
                values.append('1' if value else '0')
            else:
                values.append(str(value))
        values_list.append(f"({', '.join(values)})")

    sql += ',\n'.join(values_list) + ';\n\n'
    return sql

def main():
    """Main function to generate all data"""
    print("Generating random data for Academy Lite database...")

    # Generate base data first (no dependencies)
    users = generate_users(50)
    siswa = generate_siswa(30)
    kelas_programming = generate_kelas_programming(10)
    forum_categories = generate_forum_categories(5)
    free_classes = generate_free_classes([u['id'] for u in users], 15)
    workshops = generate_workshops(10)
    testimonials = generate_testimonials(10)

    # Generate dependent data
    guru_ids = [u['id'] for u in users if u['role'] == 'guru']
    jadwal_kelas = generate_jadwal_kelas([k['id'] for k in kelas_programming], guru_ids, 50)

    user_ids = [u['id'] for u in users]
    siswa_ids = [s['id'] for s in siswa]
    jadwal_ids = [j['id'] for j in jadwal_kelas]

    absensi = generate_absensi(jadwal_ids, siswa_ids, 200)
    absensi_guru = generate_absensi_guru(jadwal_ids, guru_ids, 100)

    payments = generate_payments(user_ids, [k['id'] for k in kelas_programming], 20)
    payment_ids = [p['id'] for p in payments]

    premium_enrollments = generate_premium_class_enrollments([k['id'] for k in kelas_programming], user_ids, payment_ids, 30)

    forum_threads = generate_forum_threads(user_ids, [c['id'] for c in forum_categories], 20)
    thread_ids = [t['id'] for t in forum_threads]

    forum_posts = generate_forum_posts(thread_ids, user_ids, 100)

    free_class_ids = [c['id'] for c in free_classes]
    free_enrollments = generate_free_class_enrollments(free_class_ids, user_ids, 80)

    # Generate SQL
    sql_output = "-- Generated Random Data for Academy Lite\n"
    sql_output += "-- Generated on: " + datetime.now().strftime('%Y-%m-%d %H:%M:%S') + "\n\n"

    sql_output += generate_sql_insert('users', users)
    sql_output += generate_sql_insert('siswa', siswa)
    sql_output += generate_sql_insert('kelas_programming', kelas_programming)
    sql_output += generate_sql_insert('jadwal_kelas', jadwal_kelas)
    sql_output += generate_sql_insert('absensi', absensi)
    sql_output += generate_sql_insert('absensi_guru', absensi_guru)
    sql_output += generate_sql_insert('payments', payments)
    sql_output += generate_sql_insert('premium_class_enrollments', premium_enrollments)
    sql_output += generate_sql_insert('forum_categories', forum_categories)
    sql_output += generate_sql_insert('forum_threads', forum_threads)
    sql_output += generate_sql_insert('forum_posts', forum_posts)
    sql_output += generate_sql_insert('free_classes', free_classes)
    sql_output += generate_sql_insert('free_class_enrollments', free_enrollments)
    sql_output += generate_sql_insert('workshops', workshops)
    sql_output += generate_sql_insert('testimonials', testimonials)

    # Write to file
    with open('generated_data.sql', 'w', encoding='utf-8') as f:
        f.write(sql_output)

    print("Data generation completed!")
    print("Generated SQL file: generated_data.sql")
    print(f"Generated {len(users)} users")
    print(f"Generated {len(siswa)} students")
    print(f"Generated {len(kelas_programming)} programming classes")
    print(f"Generated {len(jadwal_kelas)} class schedules")
    print(f"Generated {len(absensi)} attendance records")
    print(f"Generated {len(payments)} payments")
    print(f"Generated {len(forum_threads)} forum threads")
    print(f"Generated {len(forum_posts)} forum posts")
    print(f"Generated {len(free_classes)} free classes")
    print(f"Generated {len(workshops)} workshops")
    print(f"Generated {len(testimonials)} testimonials")

if __name__ == "__main__":
    main()