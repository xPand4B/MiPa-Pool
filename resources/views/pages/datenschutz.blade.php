@extends('layouts.main')

@section('title', '| Datenschutz')

@section('headline')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0 p-0 bg-transparent">
            <li class="breadcrumb-item active" aria-current="page">Datenschutz</li>
        </ol>
    </nav>
@endsection
    
@section('content')

    <div class="col-md">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header card-header-success">
                <h4 class="card-title">Datenschutzerklärung</h4>
                <p class="card-category"></p>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                <p>
                    <b>
                        Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst und halten uns strikt an die Regeln der Datenschutzgesetze.
                        Personenbezogene Daten werden auf dieser Webseite nur im technisch notwendigen Umfang erhoben.
                        In keinem Fall werden die erhobenen Daten verkauft oder aus anderen Gründen an Dritte weitergegeben.
                    </b>

                    <h2>Grundlegendes</h2>
                        <p>
                            Diese Datenschutzerklärung soll die Nutzer dieser Website über die Art, den Umfang und den Zweck der Erhebung und Verwendung
                            personenbezogener Daten durch die Websitebetreiber informieren.
                            <br>
                            Kontaktmöglichkeiten finden Sie im <a href="{{ route('impressum') }}">Impressum</a>.
                        </p>
                        <p>
                            Die Websitebetreiber nehmen Ihren Datenschutz sehr ernst und behandelt Ihre personenbezogenen Daten vertraulich und entsprechend der gesetzlichen Vorschriften.
                            Da durch neue Technologien und die ständige Weiterentwicklung dieser Webseite Änderungen an dieser Datenschutzerklärung vorgenommen werden können,
                            empfehlen wir Ihnen sich die Datenschutzerklärung in regelmäßigen Abständen wieder durchzulesen.
                        </p>
                        <p>
                            Definitionen der verwendeten Begriffe (z.B. “personenbezogene Daten” oder “Verarbeitung”) finden Sie in Art. 4 DSGVO.
                        </p>
                
                    <br>
                    <h2>Datenerfassung beim Besuch unserer Website</h2>
                    <p>
                        Bei der bloß informatorischen Nutzung unserer Website, also wenn Sie sich nicht haben registieren lassen, erheben wir keine weiteren Daten.
                        Eine Weitergabe oder anderweitige Verwendung der für die Nutzung des Verleihsystems notwendigen Daten findet nicht statt.
                    </p>
                
                    <br>
                    <h2>Rechte des Nutzers</h2>
                        <p>
                            <i><u>Auskunftsrecht gemäß Art. 15 DSGVO:</u></i>
                        </p>
                        <p>
                            Sie haben als Nutzer das Recht, auf Antrag eine kostenlose Auskunft darüber zu erhalten,
                            welche personenbezogenen Daten über Sie gespeichert wurden.
                        </p>
                
                        <p>
                            <i><u>Recht auf Berichtigung gemäß Art. 16 DSGVO:</u></i>
                        </p>
                        <p>
                            Sie haben außerdem das Recht auf Berichtigung falscher Daten und auf die Verarbeitungseinschränkung
                            oder Löschung Ihrer personenbezogenen Daten.
                        </p>
                
                        <p>
                            <i><u>Recht auf Löschung gemäß Art. 17 DSGVO:</u></i>
                        </p>
                        <p>
                            Sofern Ihr Wunsch nicht mit einer gesetzlichen Pflicht zur Aufbewahrung von Daten (z. B. Vorratsdatenspeicherung) kollidiert,
                            haben Sie ein Anrecht auf Löschung Ihrer Daten. Von uns gespeicherte Daten werden, sollten sie für ihre Zweckbestimmung nicht mehr vonnöten sein und
                            es keine gesetzlichen Aufbewahrungsfristen geben, gelöscht. Falls eine Löschung nicht durchgeführt werden kann, da die Daten für
                            zulässige gesetzliche Zwecke erforderlich sind, erfolgt eine Einschränkung der Datenverarbeitung.
                            In diesem Fall werden die Daten gesperrt und nicht für andere Zwecke verarbeitet.
                        </p>
                        <p>
                            Falls zutreffend, können Sie auch Ihr Recht auf Datenportabilität geltend machen. Sollten Sie annehmen,
                            dass Ihre Daten unrechtmäßig verarbeitet wurden, können Sie eine Beschwerde bei der zuständigen Aufsichtsbehörde einreichen.
                        </p>
                
                
                    <br>
                    <h2>Kontaktaufnahme</h2>
                    <p>
                        Im Rahmen der Kontaktaufnahme mit uns (z.B. per Telefon oder E-Mail) werden personenbezogene Daten erhoben.
                    </p>
                    <p>
                        Erhobene, personenbezogene Daten:
                    </p>
                    <p>
                        - Vor- und Zuname
                    </p>
                    <p>
                        - E-Mail Addresse oder Telefonnummer (abhängig von der Art der Kontaktaufnahme)
                    </p>
                
                
                    <br>
                    <h2>Weitere Informationen</h2>
                        <p>
                            Ihr Vertrauen ist uns wichtig. Daher möchten wir Ihnen jederzeit Rede und Antwort bezüglich der Verarbeitung Ihrer personenbezogenen Daten stehen.
                            Wenn Sie Fragen haben, die Ihnen diese Datenschutzerklärung nicht beantworten konnte oder wenn Sie zu einem Punkt vertiefte Informationen wünschen,
                            wenden Sie sich bitte über die Kontaktdaten (zu finden im <a href="{{ route('impressum') }}">Impressum</a>) an uns.
                        </p>
                
                    <br><br>
                    <p>
                        <b>
                            Muster von <a href="https://www.datenschutz.org" target="_blank">https://www.datenschutz.org</a>
                        </b>
                    </p>
                </p>        
            </div>
        </div>
    </div>
    
@endsection    