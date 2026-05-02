@foreach($fields as $name => $field)
    <div class="mb-6">
        <label class="block text-sm font-medium text-slate-700 mb-2">{{ $field['label'] }} {{ $field['required'] ? '*' : '' }}</label>
        
        @if($field['type'] === 'textarea')
            <textarea name="{{ $name }}" {{ $field['required'] ? 'required' : '' }} rows="3"
                      class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                      placeholder="أدخل {{ $field['label'] }}">{{ $value ?? '' }}</textarea>
        
        @elseif($field['type'] === 'editor')
            <textarea name="{{ $name }}" {{ $field['required'] ? 'required' : '' }} rows="8"
                      class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all rich-editor"
                      placeholder="أدخل {{ $field['label'] }}">{{ $value ?? '' }}</textarea>

        @elseif($field['type'] === 'select')
            <select name="{{ $name }}" {{ $field['required'] ? 'required' : '' }}
                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                @foreach($field['options'] as $val => $label)
                    <option value="{{ $val }}" {{ ($value ?? '') == $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

        @elseif($field['type'] === 'checkbox')
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100">
                <span class="text-sm text-slate-600">{{ $field['label'] }}</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="{{ $name }}" value="1" {{ ($value ?? false) ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary transition-all"></div>
                </label>
            </div>

        @elseif($field['type'] === 'file')
            <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-primary hover:bg-primary/5 transition-all group relative">
                <input type="file" name="{{ $name }}" id="file-{{ $name }}" accept="image/*" class="hidden file-input" data-preview="preview-{{ $name }}">
                <label for="file-{{ $name }}" class="cursor-pointer">
                    <div id="preview-{{ $name }}" class="flex flex-col items-center justify-center">
                        @if(isset($value) && $value)
                            <img src="{{ asset('storage/' . $value) }}" class="w-32 h-32 object-cover rounded-lg mb-2 shadow-md">
                            <p class="text-xs text-primary font-bold">تغيير الصورة</p>
                        @else
                            <span class="material-symbols-outlined text-4xl text-slate-400 group-hover:scale-110 transition-transform">cloud_upload</span>
                            <p class="text-xs text-slate-500 mt-2">انقر لرفع {{ $field['label'] }}</p>
                        @endif
                    </div>
                </label>
            </div>

        @else
            <input type="{{ $field['type'] }}" name="{{ $name }}" value="{{ $value ?? '' }}" {{ $field['required'] ? 'required' : '' }}
                   class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                   placeholder="أدخل {{ $field['label'] }}">
        @endif
    </div>
@endforeach
