<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Informasi Profil</h2>
        <p class="mt-1 text-sm text-gray-600">Perbarui data pribadi, pendidikan, keterampilan, dan pengalaman kerja.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-input-label for="name" :value="'Nama Lengkap'" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="email" :value="'Email'" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div>
                <x-input-label for="nim" :value="'NIM / Nomor Registrasi'" />
                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" :value="old('nim', $user->nim)" />
                <x-input-error class="mt-2" :messages="$errors->get('nim')" />
            </div>
            <div>
                <x-input-label for="phone" :value="'Nomor Telepon'" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div>
                <x-input-label for="user_type" :value="'Status Pengguna'" />
                <select id="user_type" name="user_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="mahasiswa" @selected(old('user_type', $user->user_type) === 'mahasiswa')>Mahasiswa</option>
                    <option value="alumni" @selected(old('user_type', $user->user_type) === 'alumni')>Alumni</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('user_type')" />
            </div>
            <div>
                <x-input-label for="graduation_year" :value="'Tahun Lulus'" />
                <x-text-input id="graduation_year" name="graduation_year" type="number" class="mt-1 block w-full" :value="old('graduation_year', optional($user->profile)->graduation_year)" />
                <x-input-error class="mt-2" :messages="$errors->get('graduation_year')" />
            </div>
            <div class="md:col-span-2">
                <x-input-label for="study_program" :value="'Program Studi'" />
                <x-text-input id="study_program" name="study_program" type="text" class="mt-1 block w-full" :value="old('study_program', optional($user->profile)->study_program)" />
                <x-input-error class="mt-2" :messages="$errors->get('study_program')" />
            </div>
            <div class="md:col-span-2">
                <x-input-label for="address" :value="'Alamat'" />
                <textarea id="address" name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address', optional($user->profile)->address) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <x-input-label for="education_history" :value="'Riwayat Pendidikan'" />
                <textarea id="education_history" name="education_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('education_history', optional($user->profile)->education_history) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <x-input-label for="skills" :value="'Keterampilan'" />
                <textarea id="skills" name="skills" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('skills', optional($user->profile)->skills) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <x-input-label for="work_experience" :value="'Pengalaman Kerja'" />
                <textarea id="work_experience" name="work_experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('work_experience', optional($user->profile)->work_experience) }}</textarea>
            </div>
            <div>
                <x-input-label for="current_company" :value="'Perusahaan Saat Ini'" />
                <x-text-input id="current_company" name="current_company" type="text" class="mt-1 block w-full" :value="old('current_company', optional($user->profile)->current_company)" />
            </div>
            <div>
                <x-input-label for="current_position" :value="'Posisi Saat Ini'" />
                <x-text-input id="current_position" name="current_position" type="text" class="mt-1 block w-full" :value="old('current_position', optional($user->profile)->current_position)" />
            </div>
            <div class="md:col-span-2">
                <x-input-label for="linkedin_url" :value="'URL LinkedIn'" />
                <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', optional($user->profile)->linkedin_url)" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan Profil</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-emerald-600">Profil berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>
