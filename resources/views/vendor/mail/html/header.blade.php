<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Medisoft')
<img src="https://raw.githubusercontent.com/srijanpanta/image/main/logo.png" class="navbar-brand" style="max-width: 300px" alt="Medisoft Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
